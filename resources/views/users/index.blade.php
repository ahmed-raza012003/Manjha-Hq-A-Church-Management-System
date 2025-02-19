@extends('layouts.base')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .btn-custom {
        background-color: #5541D7;
        color: white;
        padding-left: 25px;
        padding-right: 25px;
    }
    .btn-custom:hover{
        background-color: #5541D7;
        color: white;
    }
    .buttons {
        border: 1px solid #5541D7;
        color: #5541D7;
    }
    .buttons:hover {
        border: 1px solid #5541D7;
        color: #5541D7;
    }
    .button-outlined {
        background-color: #5541D7;
        color: white;
    }
    .button-outlined:hover {
        background-color: #5541D7;
        color: white;
    }
    .table-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .pagination-summary {
        margin: 0 15px;
    }

    .custom-pagination {
        color: #5541D7 !important;
        border-color: #5541D7 !important;
    }

    .custom-pagination:hover {
        background-color: #5541D7 !important;
        color: #fff !important;
    }

    .page-item.active .page-link {
        background-color: #5541D7 !important;
        border-color: #5541D7 !important;
        color: #fff !important;
    }

    .dropdown-menu {
        position: absolute;
        top: 0;
        right: 0;
        left: auto;
        display: block;
        margin-top: 10px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0,0,0,.2);
        z-index: 1;
        display: none;
    }

    .dropdown-item {
        color:rgb(0, 0, 0);
        font-size: 14px;
    }

    .dropdown-item:hover {
        color:rgb(255, 255, 255);
        background-color: #5541D7;
    }

    .three-dot-btn {
        border: none;
        background: none;
        color: #5541D7;
        font-size: 18px;
        cursor: pointer;
    }

    .action-btn-container {
        position: relative;
    }

    td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

</style>

<div class="container mt-4">
    <h2 class="mb-3">User Management</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-custom">+ Add User</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light text-muted">
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Church</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $count = 1; @endphp
                @foreach($users as $user)
                    @if(
                        !$user->roles->contains('name', 'super admin') &&  
                        $user->church_name === auth()->user()->church_name 
                    )
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles->pluck('name')->first() }}</td>
                            <td>{{ $user->church_name }}</td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-custom">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirmDelete(this)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- 🔹 Delete Confirmation Script --}}
<script>
    function confirmDelete(form) {
        return confirm("Are you sure you want to delete this user?");
    }
</script>

@endsection
