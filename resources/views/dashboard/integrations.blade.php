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
    }

    /* Custom Purple Switch */
.custom-switch {
  width: 10rem;
  height: 1.2rem;
  background-color: #d8d8d8;
  border: none;
  cursor: pointer;
}

.custom-switch:checked {
  background-color: #5541D7; /* Purple color */
  border-color: #5541D7;
}

.custom-switch:focus {
  box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
}
  </style>


<div class="container mt-4">
    <!-- Page Header -->
    <div class="text-left mb-2">
      <h4 class="section-title" >Integrations</h4>
      <p class="text-muted">
        Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry. Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.
      </p>
    </div>
  
    <!-- Payments Section -->
    <div class="mb-2">
      <h4 class="section-title">Payments</h4>
      <p class="section-subtitle">Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
      <div class="row">
        <!-- PayPal -->
        <div class="col-md-4 mb-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <img src="https://via.placeholder.com/40" alt="PayPal">
              <div class="form-check form-switch">
                <input class="form-check-input custom-switch" type="checkbox" checked>
              </div>
            </div>
            <h6>PayPal</h6>
            <p>Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
          </div>
        </div>
  
        <!-- Stripe -->
        <div class="col-md-4 mb-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <img src="https://via.placeholder.com/40" alt="Stripe">
              <div class="form-check form-switch">
                <input class="form-check-input custom-switch" type="checkbox">
              </div>
            </div>
            <h6>Stripe</h6>
            <p>Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
          </div>
        </div>
  
        <!-- Google Pay -->
        <div class="col-md-4 mb-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <img src="https://via.placeholder.com/40" alt="Google Pay">
              <div class="form-check form-switch">
                <input class="form-check-input custom-switch" type="checkbox">
              </div>
            </div>
            <h6>Google Pay</h6>
            <p>Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Bulk Email Section -->
    <div class="mb-4">
      <h4 class="section-title">Bulk Email</h4>
      <p class="section-subtitle">Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
      <div class="row">
        <!-- Dropbox -->
        <div class="col-md-4 mb-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <img src="https://via.placeholder.com/40" alt="Dropbox">
              <div class="form-check form-switch">
                <input class="form-check-input custom-switch" type="checkbox">
              </div>
            </div>
            <h6>Dropbox</h6>
            <p>Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
          </div>
        </div>
  
        <!-- Google Docs -->
        <div class="col-md-4 mb-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <img src="https://via.placeholder.com/40" alt="Google Docs">
              <div class="form-check form-switch">
                <input class="form-check-input custom-switch" type="checkbox">
              </div>
            </div>
            <h6>Google Docs</h6>
            <p>Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
          </div>
        </div>
  
        <!-- MailChimp -->
        <div class="col-md-4 mb-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <img src="https://via.placeholder.com/40" alt="MailChimp">
              <div class="form-check form-switch">
                <input class="form-check-input custom-switch" type="checkbox">
              </div>
            </div>
            <h6>MailChimp</h6>
            <p>Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
          </div>
        </div>
      </div>
    </div>
  
    <!-- APIs Section -->
    <div>
      <h4 class="section-title">APIs</h4>
      <p class="section-subtitle">Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
      <div class="row">
        <!-- Google Ads -->
        <div class="col-md-4 mb-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <img src="https://via.placeholder.com/40" alt="Google Ads">
              <div class="form-check form-switch">
                <input class="form-check-input custom-switch" type="checkbox">
              </div>
            </div>
            <h6>Google Ads</h6>
            <p>Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
          </div>
        </div>
  
        <!-- API 1 -->
        <div class="col-md-4 mb-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <img src="https://via.placeholder.com/40" alt="API 1">
              <div class="form-check form-switch">
                <input class="form-check-input custom-switch" type="checkbox">
              </div>
            </div>
            <h6>API 1</h6>
            <p>Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
          </div>
        </div>
  
        <!-- API 2 -->
        <div class="col-md-4 mb-3">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <img src="https://via.placeholder.com/40" alt="API 2">
              <div class="form-check form-switch">
                <input class="form-check-input custom-switch" type="checkbox">
              </div>
            </div>
            <h6>API 2</h6>
            <p>Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection

