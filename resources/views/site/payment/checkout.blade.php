@extends('site.layouts.app')

@section('css')
    <style>
        .checkout-container {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .checkout-header {
            background: #4361ee;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .checkout-body {
            padding: 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .order-summary {
            flex: 1;
            min-width: 300px;
        }

        .payment-details {
            flex: 1;
            min-width: 300px;
        }

        .checkout-divider {
            width: 100%;
            height: 1px;
            background: #eee;
            margin: 20px 0;
        }

        .course-item {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .course-image {
            width: 100px;
            height: 70px;
            border-radius: 4px;
            object-fit: cover;
            margin-right: 15px;
        }

        .course-info {
            flex: 1;
        }

        .course-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .course-instructor {
            color: #666;
            font-size: 14px;
        }

        .course-price {
            font-weight: 700;
            color: #4361ee;
        }

        .price-summary {
            margin-top: 20px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .price-total {
            font-weight: 700;
            font-size: 18px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid #eee;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .payment-methods {
            margin: 25px 0;
        }

        .payment-method {
            display: block;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .payment-method:hover {
            border-color: #4361ee;
        }

        .payment-method input {
            margin-right: 10px;
        }

        .btn-checkout {
            background-color: #4361ee;
            color: white;
            padding: 15px 25px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s;
        }

        .btn-checkout:hover {
            background-color: #3048c5;
        }

        @media (max-width: 768px) {
            .checkout-body {
                flex-direction: column;
            }
        }
    </style>
@endsection

@section('hero')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center py-4">
                <h1>Checkout</h1>
                <p>Complete your purchase to get access to the course</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="checkout-container">
            <div class="checkout-header">
                <h2>Complete Your Order</h2>
            </div>

            <div class="checkout-body">
                <div class="order-summary">
                    <h3>Order Summary</h3>
                    <div class="checkout-divider"></div>

                    <div class="course-item">
                        @if ($course->getImageUrl())
                            <img src="{{ $course->getImageUrl() }}" alt="{{ $course->subject->name }}" class="course-image">
                        @else
                            <img src="/images/course-placeholder.jpg" alt="{{ $course->subject->name }}"
                                class="course-image">
                        @endif
                        <div class="course-info">
                            <div class="course-title">{{ $course->subject->name }}</div>
                            <div class="course-instructor">By {{ $course->teacher->name }}</div>
                            <div class="course-price">{{ $course->price }} EGP</div>
                        </div>
                    </div>

                    <div class="price-summary">
                        <div class="price-row">
                            <span>Original Price:</span>
                            <span>{{ $course->price }} EGP</span>
                        </div>
                        @if ($discount > 0)
                            <div class="price-row">
                                <span>Discount:</span>
                                <span>-{{ $discount }} EGP</span>
                            </div>
                        @endif
                        <div class="price-row">
                            <span>Tax:</span>
                            <span>{{ $tax }} EGP</span>
                        </div>
                        <div class="price-row price-total">
                            <span>Total:</span>
                            <span>{{ $total }} EGP</span>
                        </div>
                    </div>
                </div>

                <div class="payment-details">
                    <h3>Payment Details</h3>
                    <div class="checkout-divider"></div>

                    <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <input type="hidden" name="amount" value="{{ $total }}">

                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ Auth::user()->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ Auth::user()->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-control"
                                value="{{ Auth::user()->phone ?? '' }}" placeholder="e.g. 01012345678" required>
                        </div>

                        <div class="payment-methods">
                            <h4>Payment Method</h4>

                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="card" checked>
                                Credit/Debit Card
                            </label>

                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="wallet">
                                Mobile Wallet
                            </label>

                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="installment">
                                Installment Payment
                            </label>
                        </div>

                        <button type="submit" class="btn-checkout">Complete Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
