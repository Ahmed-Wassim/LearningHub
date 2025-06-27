@extends('site.layouts.app')

@section('css')
    <style>
        .success-container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
        }

        .success-header {
            background: #4CAF50;
            color: white;
            padding: 30px;
        }

        .success-icon {
            font-size: 60px;
            margin-bottom: 15px;
        }

        .success-body {
            padding: 40px 30px;
        }

        .order-details {
            background: #f9f9f9;
            border-radius: 6px;
            padding: 20px;
            margin: 30px 0;
            text-align: left;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
        }

        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .detail-label {
            font-weight: 600;
            color: #555;
        }

        .detail-value {
            text-align: right;
        }

        .action-buttons {
            margin-top: 30px;
        }

        .btn-view-course {
            background-color: #4361ee;
            color: white;
            padding: 12px 25px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            margin-right: 15px;
            display: inline-block;
        }

        .btn-view-course:hover {
            background-color: #3048c5;
        }

        .btn-continue-shopping {
            color: #4361ee;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-continue-shopping:hover {
            text-decoration: underline;
        }
    </style>
@endsection

@section('hero')
    <!-- No hero section for success page -->
@endsection

@section('content')
    <div class="container">
        <div class="success-container">
            <div class="success-header">
                <div class="success-icon">✓</div>
                <h1>Payment Successful!</h1>
                <p>Your course purchase has been completed</p>
            </div>

            <div class="success-body">
                <h2>Thank you for your purchase!</h2>
                <p>Your payment has been processed successfully and you now have access to the course. We've sent a
                    confirmation email with all the details to your registered email address.</p>

                <div class="order-details">
                    <h3>Order Summary</h3>

                    <div class="detail-row">
                        <span class="detail-label">Order Number:</span>
                        <span class="detail-value">#{{ $enrollment->id }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Course:</span>
                        <span class="detail-value">{{ $enrollment->course->subject->name }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Instructor:</span>
                        <span class="detail-value">{{ $enrollment->course->user->name }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Date:</span>
                        <span class="detail-value">{{ $enrollment->created_at->format('F j, Y') }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Payment Method:</span>
                        <span class="detail-value">{{ ucfirst($enrollment->payment_method) }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Amount Paid:</span>
                        <span class="detail-value">{{ $enrollment->amount }} EGP</span>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('courses.learn', ['id' => $enrollment->subject_user_id]) }}"
                        class="btn-view-course">Start Learning</a>
                    <a href="{{ route('courses.index') }}" class="btn-continue-shopping">Browse More Courses</a>
                </div>
            </div>
        </div>
    </div>
@endsection
