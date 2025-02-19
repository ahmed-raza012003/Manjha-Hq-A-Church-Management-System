@extends('layouts.base')

@section('content')
<div class="container mt-4">
    <h2 style="color: #5541D7">Create User</h2>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="">Select Role</option>
                @foreach($roles as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Church Name</label>
            <input type="text" class="form-control" value="{{ $churchName }}" disabled>
        </div>

        <!-- Hidden Fields -->
        <input type="hidden" name="church_name" value="{{ auth()->user()->church_name }}">
        <input type="hidden" name="stripe_customer_id" value="{{ auth()->user()->stripe_customer_id }}">
        <input type="hidden" name="stripe_subscription_id" value="{{ auth()->user()->stripe_subscription_id }}">
        <input type="hidden" name="package_id" value="{{ auth()->user()->package_id }}">
        <input type="hidden" name="subscription_ends_at" value="{{ auth()->user()->subscription_ends_at }}">
        <input type="hidden" name="status" value="active">
        <input type="hidden" name="expires_at" value="{{ auth()->user()->subscription_ends_at }}">

        <button type="submit" class="btn btn-custom">Create</button>
    </form>
</div>

<style>
    .side-nav {
        list-style-type: none;
        padding: 0;
        margin: 0;
        border-right: 1px solid #ddd;
    }

    .side-nav li {
        padding: 10px;
        cursor: pointer;
    }

    .side-nav li:hover {
        color: #5541D7;
    }

    .side-nav li.active {
        font-weight: bold;
        color: #5541D7;
    }

    .section {
        display: none;
    }

    .section.active {
        display: block;
    }

    .btn-custom {
        background-color: #5541D7;
        color: white;
        border: none;
    }

    .btn-custom:hover {
        background-color: rgb(255, 255, 255);
        color: #5541D7;
        border: 1px solid #5541D7;
    }

    .btn-save-draft {
        background-color: rgb(255, 255, 255);
        color: #5541D7;
        border: 1px solid #5541D7;
    }

    .btn-save-draft:hover {
        background-color: #5541D7;
        color: white;
    }

    .button-group {
        display: flex;
        justify-content: flex-start;
        gap: 10px;
        margin-top: 20px;
    }

    .button-group button {
        width: auto;
    }
</style>
@endsection
