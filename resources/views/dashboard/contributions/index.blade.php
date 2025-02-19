@extends('layouts.base')

@section('content')
<div class="container">
    <h1 class="mb-4">Contributions</h1>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('contributions.index') }}"><i class="fas fa-list"></i> List</a>
        </li>
      
    </ul>

    <!-- Filters -->
    <form action="{{ route('contributions.index') }}" method="GET" class="d-flex mb-4">
        <input type="text" name="search" placeholder="Search by Name" class="form-control me-2" value="{{ request()->search }}">
        <select name="fund" class="form-control me-2">
            <option value="">All Funds</option>
            <option value="General Fund" {{ request()->fund == 'General Fund' ? 'selected' : '' }}>General Fund</option>
            <option value="Missions Fund" {{ request()->fund == 'Missions Fund' ? 'selected' : '' }}>Missions Fund</option>
        </select>
        <input type="date" name="from" class="form-control me-2" value="{{ request()->from }}">
        <input type="date" name="to" class="form-control me-2" value="{{ request()->to }}">
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Overview Section -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Total Amount</h5>
                    <h3 class="text-primary">Rs {{ number_format($totalAmount, 2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Total Contributors</h5>
                    <h3 class="text-success">{{ $totalContributors }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Total Contributions</h5>
                    <h3 class="text-info">{{ $contributions->total() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Contributions Table -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Fund</th>
                    <th>Method</th>
                    <th>Batch</th>
                  
                </tr>
            </thead>
            <tbody>
                @forelse($contributions as $contribution)
                    <tr>
                        <td>{{ $contribution->date }}</td>
                        <td>
                            {{ $contribution->member->first_name ?? 'Anonymous' }}
                        </td>
                        <td>Rs {{ number_format($contribution->amount, 2) }}</td>
                        <td>{{ $contribution->fund }}</td>
                        <td>{{ $contribution->payment_method }}</td>
                        <td>{{ $contribution->batch_id }}</td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No contributions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center">
        <p>Showing {{ $contributions->firstItem() }} to {{ $contributions->lastItem() }} of {{ $contributions->total() }} items</p>
        {{ $contributions->links() }}
    </div>
</div>
@endsection
