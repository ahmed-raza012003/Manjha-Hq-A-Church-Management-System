@extends('layouts.base')

@section('content')
<style>
    .section-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #565656;
    }

    .section-subtitle {
        color: #6c757d;
        margin-bottom: 20px;
        line-height: 10px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .card h6 {
        color: #565656;
        font-size: 16px;
        font-weight: bold;
        margin-top: 10px;
    }

    .card p {
        font-size: 14px;
        color: #6c757d;
        flex-grow: 1;
    }

    .custom-switch {
        width: 10rem;
        height: 1.2rem;
        background-color: #d8d8d8;
        border: none;
        cursor: pointer;
        margin-top: auto;
    }

    .custom-switch:checked {
        background-color: #5541D7; 
        border-color: #5541D7;
    }

    .custom-switch:focus {
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .col-md-4 {
        flex: 1 0 30%;
        margin-bottom: 1.5rem;
    }

    .card-body {
        padding: 15px;
    }

    /* Icon size adjustments */
    .card img {
        width: 40px;
        height: 40px;
    }

    /* Colorful Icons */
    .google-icon {
        color: #db4437; /* Google red */
    }

    .facebook-icon {
        color: #3b5998; /* Facebook blue */
    }

    .stripe-icon {
        color: #6772e5; /* Stripe blue */
    }

    .cashapp-icon {
        color: #00b140; /* Cash App green */
    }

    .paypal-icon {
        color: #00457c; /* PayPal blue */
    }

    .whatsapp-icon {
        color: #25D366; /* WhatsApp green */
    }

    .sms-icon {
        color: #00aaff; /* SMS blue */
    }
</style>

<div class="container mt-4">
    <!-- Page Header -->
    <div class="text-left mb-2">
        <h4 class="section-title">Integrations</h4>
        <p class="text-muted">
            Seamlessly integrate with leading services for a smooth experience.
        </p>
    </div>

    <!-- Authentication Integrations Section -->
    <div class="mb-2">
        <h4 class="section-title">Authentication Integrations</h4>
        <p class="section-subtitle">Enable authentication via Google or Facebook and manage settings.</p>
        <div class="row">
            <!-- Google Authentication -->
            <div class="col-md-4 mb-3">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="bi bi-google google-icon" style="font-size: 30px;"></i> <!-- Google Authentication Icon -->
                        <div class="form-check form-switch">
                         
                        </div>
                    </div>
                    <h6>Google Authentication</h6>
                    <p>Enable Google sign-in, manage API keys, and configure OAuth2 settings for seamless integration.</p>
                </div>
            </div>

            <!-- Facebook Authentication -->
            <div class="col-md-4 mb-3">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="bi bi-facebook facebook-icon" style="font-size: 30px;"></i> <!-- Facebook Authentication Icon -->
                        <div class="form-check form-switch">
                         
                        </div>
                    </div>
                    <h6>Facebook Authentication</h6>
                    <p>Enable Facebook login, manage Facebook app settings, and configure permissions for users.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Integrations Section -->
    <div class="mb-2">
        <h4 class="section-title">Payment Integrations</h4>
        <p class="section-subtitle">Link your platform with top payment services for seamless transactions.</p>
        <div class="row">
            <!-- Stripe Payment -->
            <div class="col-md-4 mb-3">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="bi bi-credit-card stripe-icon" style="font-size: 30px;"></i> <!-- Stripe Payment Icon -->
                        <div class="form-check form-switch">
                         
                        </div>
                    </div>
                    <h6>Stripe Payment</h6>
                    <p>Link with Stripe payment gateway, manage subscriptions, and set up webhooks for smooth payments.</p>
                </div>
            </div>

            <!-- Cash App Payment -->
            <div class="col-md-4 mb-3">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="bi bi-wallet cashapp-icon" style="font-size: 30px;"></i> <!-- Cash App Payment Icon -->
                        <div class="form-check form-switch">
                         
                        </div>
                    </div>
                    <h6>Cash App Payment</h6>
                    <p>Link Cash App to your account, enable Cash App payments, and track transactions easily.</p>
                </div>
            </div>

            <!-- PayPal Payment -->
            <div class="col-md-4 mb-3">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="bi bi-paypal paypal-icon" style="font-size: 30px;"></i> <!-- PayPal Payment Icon -->
                        <div class="form-check form-switch">
                         
                        </div>
                    </div>
                    <h6>PayPal Payment</h6>
                    <p>Connect your PayPal account, configure payment settings, and set up IPN notifications for PayPal.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Communication Integrations Section -->
    <div>
        <h4 class="section-title">Communication Integrations</h4>
        <p class="section-subtitle">Integrate communication services such as Gmail, SMS, and WhatsApp.</p>
        <div class="row">
            <!-- Gmail Integration -->
            <div class="col-md-4 mb-3">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="bi bi-envelope gmail-icon" style="font-size: 30px;"></i> <!-- Gmail Integration Icon -->
                        <div class="form-check form-switch">
                         
                        </div>
                    </div>
                    <h6>Gmail Integration</h6>
                    <p>Sync Gmail with your account, manage email templates, and send notifications via Gmail.</p>
                </div>
            </div>

            <!-- Text Messaging -->
            <div class="col-md-4 mb-3">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="bi bi-chat-left sms-icon" style="font-size: 30px;"></i> <!-- Text Messaging Icon -->
                        <div class="form-check form-switch">
                         
                        </div>
                    </div>
                    <h6>Text Messaging</h6>
                    <p>Send SMS notifications, manage phone number settings, and sync with messaging services.</p>
                </div>
            </div>

            <!-- WhatsApp Integration -->
            <div class="col-md-4 mb-3">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="bi bi-whatsapp whatsapp-icon" style="font-size: 30px;"></i> <!-- WhatsApp Integration Icon -->
                        <div class="form-check form-switch">
                         
                        </div>
                    </div>
                    <h6>WhatsApp Integration</h6>
                    <p>Send messages via WhatsApp, manage your WhatsApp business account, and receive WhatsApp notifications.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

@endsection
