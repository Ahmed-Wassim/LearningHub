<?php

namespace App\Http\Controllers\Site;

use App\Models\Enrollment;
use App\Models\SubjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * Display the checkout page
     */
    public function checkout(SubjectUser $course)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ensure user has student role
        if (!Auth::user()->hasRole('student')) {
            return back()->with('error', 'Only students can purchase courses.');
        }

        // Check if already enrolled
        if (Auth::user()->hasEnrolledIn($course->id)) {
            return redirect()->route('courses.show', $course)
                ->with('message', 'You are already enrolled in this course.');
        }

        // Calculate basic tax (10% example)
        $tax = round($course->price * 0.10, 2);

        // Calculate discount if applicable (can be expanded based on your business logic)
        $discount = 0;

        // Calculate total
        $total = $course->price + $tax - $discount;

        return view('site.payment.checkout', compact('course', 'tax', 'discount', 'total'));
    }

    /**
     * Process payment with Paymob
     */
    public function processPayment(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'course_id' => 'required|exists:subject_user,id',
            'amount' => 'required|numeric|min:1',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'payment_method' => 'required|in:card,wallet,installment',
        ]);

        $courseId = $validated['course_id'];
        $course = SubjectUser::findOrFail($courseId);

        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ensure user has student role
        if (!Auth::user()->isStudent()) {
            return back()->with('error', 'Only students can purchase courses.');
        }

        // Check if already enrolled
        if (Auth::user()->hasEnrolledIn($courseId)) {
            return redirect()->route('courses.show', $course)
                ->with('message', 'You are already enrolled in this course.');
        }

        try {
            // Step 1: Authentication with Paymob
            $authResponse = Http::post('https://accept.paymob.com/api/auth/tokens', [
                'api_key' => config('services.paymob.api_key'),
            ]);

            if (!$authResponse->successful()) {
                Log::error('Paymob auth failed', ['response' => $authResponse->json()]);
                return redirect()->route('payment.failed')->with('error', 'Payment service unavailable. Please try again later.');
            }

            $token = $authResponse->json('token');

            // Create a pending enrollment record
            $enrollment = Enrollment::create([
                'student_id' => Auth::id(),
                'subject_user_id' => $courseId,
                'payment_id' => null,
                'status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'amount' => $validated['amount']
            ]);

            // Step 2: Create order
            $orderResponse = Http::post('https://accept.paymob.com/api/ecommerce/orders', [
                'auth_token' => $token,
                'delivery_needed' => false,
                'amount_cents' => $validated['amount'] * 100, // Convert to cents
                'currency' => 'EGP', // Change as needed
                'items' => [
                    [
                        'name' => $course->subject->name,
                        'amount_cents' => $validated['amount'] * 100,
                        'description' => substr($course->bio ?? $course->subject->description, 0, 100),
                        'quantity' => 1
                    ]
                ],
                'merchant_order_id' => $enrollment->id // Link to our enrollment
            ]);

            if (!$orderResponse->successful()) {
                Log::error('Paymob order creation failed', ['response' => $orderResponse->json()]);
                return redirect()->route('payment.failed')->with('error', 'Failed to create order. Please try again.');
            }

            $orderId = $orderResponse->json('id');

            // Update enrollment with payment reference
            $enrollment->update([
                'payment_reference' => $orderId
            ]);

            // Step 3: Get payment key
            $paymentResponse = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', [
                'auth_token' => $token,
                'amount_cents' => $validated['amount'] * 100,
                'expiration' => 3600,
                'order_id' => $orderId,
                'billing_data' => [
                    'email' => $validated['email'],
                    'first_name' => explode(' ', $validated['name'])[0],
                    'last_name' => count(explode(' ', $validated['name'])) > 1 ? explode(' ', $validated['name'])[1] : '',
                    'phone_number' => $validated['phone'],
                    'apartment' => 'NA',
                    'floor' => 'NA',
                    'street' => 'NA',
                    'building' => 'NA',
                    'city' => 'NA',
                    'country' => 'EG',
                    'state' => 'NA'
                ],
                'currency' => 'EGP', // Change as needed
                'integration_id' => $this->getIntegrationId($validated['payment_method'])
            ]);

            if (!$paymentResponse->successful()) {
                Log::error('Paymob payment key generation failed', ['response' => $paymentResponse->json()]);
                return redirect()->route('payment.failed')->with('error', 'Payment processing failed. Please try again.');
            }

            $paymentToken = $paymentResponse->json('token');

            // Store enrollment ID in session
            session([
                'enrollment_id' => $enrollment->id,
                'course_id' => $courseId
            ]);

            // Redirect to appropriate payment URL based on method
            return redirect()->away($this->getPaymentUrl($validated['payment_method'], $paymentToken));

        } catch (\Exception $e) {
            Log::error('Payment processing error', ['error' => $e->getMessage()]);
            return redirect()->route('payment.failed')->with('error', 'Payment processing error: ' . $e->getMessage());
        }
    }

    /**
     * Process the callback from Paymob after payment
     */
    public function callback(Request $request)
    {
        // Check success status from Paymob
        $success = $request->success === 'true';
        $enrollmentId = $request->merchant_order_id ?? session('enrollment_id');
        $enrollmentId = $enrollmentId ?? 0;

        try {
            // Find the enrollment
            $enrollment = Enrollment::findOrFail($enrollmentId);
            $course = SubjectUser::findOrFail($enrollment->subject_user_id);

            if ($success) {
                // Update enrollment record
                $enrollment->update([
                    'payment_id' => $request->transaction_id ?? null,
                    'status' => 'completed'
                ]);

                // Clear payment session data
                session()->forget(['enrollment_id', 'course_id']);

                return redirect()->route('payment.success', ['enrollment_id' => $enrollment->id]);
            }

            // If payment failed
            $enrollment->update(['status' => 'failed']);
            return redirect()->route('payment.failed')->with('error', 'Payment was declined by the payment provider.');

        } catch (\Exception $e) {
            Log::error('Payment callback error', ['error' => $e->getMessage()]);
            return redirect()->route('payment.failed')->with('error', 'Error processing payment confirmation.');
        }
    }

    /**
     * Show success page after payment
     */
    public function success($enrollment_id)
    {
        try {
            $enrollment = Enrollment::with(['student', 'course.subject'])->findOrFail($enrollment_id);

            // Ensure this belongs to the current user for security
            if ($enrollment->student_id !== Auth::id()) {
                return redirect()->route('levels.index')->with('error', 'Unauthorized access');
            }

            return view('site.payment.success', compact('enrollment'));
        } catch (\Exception $e) {
            return redirect()->route('levels.index');
        }
    }

    /**
     * Show failed payment page
     */
    public function failed()
    {
        return view('site.payment.failed');
    }

    // /**
    //  * Webhook to receive notifications from Paymob
    //  */
    // public function webhook(Request $request)
    // {
    //     // Verify the webhook signature if needed
    //     // Process payment confirmation

    //     Log::info('Paymob webhook received', ['data' => $request->all()]);

    //     // Check if payment was successful
    //     if ($request->obj && $request->obj['success'] === true) {
    //         $transactionId = $request->obj['id'] ?? null;
    //         $orderId = $request->obj['order'] ? $request->obj['order']['merchant_order_id'] : null;

    //         if ($orderId) {
    //             try {
    //                 // Find the enrollment based on payment reference
    //                 $enrollment = Enrollment::where('id', $orderId)->first();

    //                 if ($enrollment) {
    //                     $enrollment->update([
    //                         'status' => 'completed',
    //                         'payment_id' => $transactionId
    //                     ]);

    //                     Log::info('Enrollment completed via webhook', ['enrollment_id' => $enrollment->id]);
    //                 }
    //             } catch (\Exception $e) {
    //                 Log::error('Webhook processing error', ['error' => $e->getMessage()]);
    //             }
    //         }
    //     }

    //     return response()->json(['status' => 'success']);
    // }

    /**
     * Get the appropriate integration ID based on payment method
     */


    private function getIntegrationId($paymentMethod)
    {
        switch ($paymentMethod) {
            case 'card':
                return config('services.paymob.card_integration_id', config('services.paymob.integration_id'));
            case 'wallet':
                return config('services.paymob.wallet_integration_id', config('services.paymob.integration_id'));
            case 'installment':
                return config('services.paymob.installment_integration_id', config('services.paymob.integration_id'));
            default:
                return config('services.paymob.integration_id');
        }
    }

    /**
     * Get the payment URL based on payment method
     */
    private function getPaymentUrl($paymentMethod, $token)
    {
        $baseUrl = 'https://accept.paymobsolutions.com/api/acceptance/';

        switch ($paymentMethod) {
            case 'card':
                $iframeId = config('services.paymob.iframe_id');
                return $baseUrl . "iframes/$iframeId?payment_token=$token";
            case 'wallet':
                return $baseUrl . "payments/pay?payment_token=$token&source=wallet";
            case 'installment':
                $installmentIframeId = config('services.paymob.installment_iframe_id', config('services.paymob.iframe_id'));
                return $baseUrl . "iframes/$installmentIframeId?payment_token=$token";
            default:
                $iframeId = config('services.paymob.iframe_id');
                return $baseUrl . "iframes/$iframeId?payment_token=$token";
        }
    }
}
