@extends('site.layouts.app')

@section('css')
    <style>
        .failed-container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
        }

        .failed-header {
            background: #f44336;
            color: white;
            padding: 30px;
        }

        .failed-icon {
            font-size: 60px;
            margin-bottom: 15px;
        }

        .failed-body {
            padding: 40px 30px;
        }

        .error-message {
            background: #fff8f8;
            border-left: 4px solid #f44336;
            padding: 15px;
            margin: 20px 0;
            text-align: left;
        }

        .action-buttons {
            margin-top: 30px;
        }

        .btn-try-again {
            background-color: #4361ee;
            color: white;
            padding: 12px 25px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            margin-right: 15px;
            display: inline-block;
        }

        .btn-try-again:hover {
            background-color: #3048c5;
        }

        .btn-contact-support {
            color: #4361ee;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-contact-support:hover {
            text-decoration: underline;
        }

        .troubleshooting-tips {
            margin-top: 30px;
            text-align: left;
            background: #f5f5f5;
            padding: 20px;
            border-radius: 6px;
        }

        .troubleshooting-tips ul {
            margin-left: 20px;
        }

        .troubleshooting-tips li {
            margin-bottom: 8px;
        }
    </style>
@endsection

@section('hero')
    <!-- No hero section for failed page -->
@endsection

@section('content')
    <div class="container">
        <div class="failed-container">
            <div class="failed-header">
                <div class="failed-icon">✗</div>
                <h1>Payment Failed</h1>
                <p>We were unable to process your payment</p>
            </div>

            <div class="failed-body">
                <h2>Something went wrong</h2>
                <p>Your payment could not be processed at this time. No charges have been made to your account.</p>

                @if (session('error'))
                    <div class="error-message">
                        <strong>Error:</strong> {{ session('error') }}
                    </div>
                @endif

                <div class="troubleshooting-tips">
                    <h3>Common causes for payment failure:</h3>
                    <ul>
                        <li>Insufficient funds in your account</li>
                        <li>Incorrect card details entered</li>
                        <li>Card expired or blocked for online transactions</li>
                        <li>Transaction declined by your bank</li>
                        <li>Temporary issues with the payment gateway</li>
                    </ul>
                </div>

                <div class="action-buttons">
                    <a href="{{ url()->previous() }}" class="btn-try-again">Try Again</a>
                    {{-- <a href="{{ route('contact') }}" class="btn-contact-support">Contact Support</a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
