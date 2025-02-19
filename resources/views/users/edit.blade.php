@extends('layouts.base')

@section('content')
<div class="container mt-4">
    <h2>Edit User</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" required>
                @foreach($roles as $id => $name)
                    <option value="{{ $id }}" {{ $user->roles->pluck('id')->contains($id) ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-custom">Update</button>
    </form>
</div><style>
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
