@extends('layouts.base')

@section('content')
<style>
select, select option {
    background-color: white !important;
    color: black !important;
    opacity: 1 !important;
    visibility: visible !important;
}


</style>
<div class="container mt-5">
    <form id="contribution-form" action="{{ route('contributions.store') }}" method="POST">
        @csrf
        <div class="row">
            <input type="hidden" name="church_name" value="{{ auth()->user()->church_name }}">
            <!-- Contributor and Anonymous -->
            <div class="col-md-6 mb-3 bg-white p-3">
                <label class="form-label">Contributor (Member) or Envelope Number</label>
                <select name="contributions[0][member_id]" class="form-select" required>
                    <option value="">Select</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->first_name }}</option>
                    @endforeach
                </select>
                
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" name="contributions[0][anonymous]">
                    <label class="form-check-label">Anonymous</label>
                </div>
            </div>

            <!-- Payment Method and Date -->
            <div class="col-md-6 mb-3 bg-white p-3">
                <label class="form-label">Payment Method</label>
                <select name="contributions[0][payment_method]" class="form-select" required>
                    <option selected>Select</option>
                    <option value="Stripe">Stripe</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Cash App">Cash App</option>
                </select>
                <label class="form-label mt-2">Date</label>
                <input type="date" name="contributions[0][date]" class="form-control" required>
            </div>
        </div>

        <!-- Contribution Entries -->
        <div id="contribution-entries">
            <div class="row mt-3 single-contribution">
                <div class="col-md-6 mb-3 bg-white p-3">
                    <label class="form-label">Amount</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" name="contributions[0][amount]" class="form-control amount-input" required>
                    </div>
                    <label class="form-label mt-2">Fund</label>
                    <select name="contributions[0][fund]" class="form-select" required>
                        <option selected>General Fund</option>
                        <option value="Missions Fund">Missions Fund</option>
                    </select>
                    <button type="button" class="btn btn-sm btn-custom mt-3 add-more">+ Add More</button>
                </div>

                <!-- Batch Summary -->
                <div class="col-md-6 mb-3 bg-white p-3">
                    <label class="form-label">Batch</label>
                    <select name="batch" class="form-select">
                        <option value="5" selected>5</option>
                    </select>
                    <div class="mt-5">
                        <h6>
                            <span>Total Entries: </span>
                            <span class="fw-bold" id="total-entries">1</span>
                            <span class="mx-3"></span>
                            <span>Total Amount: </span>
                            <span class="fw-bold" id="total-amount">0.00</span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
        </div>
    </form>
</div>

<!-- JavaScript -->
<script>
    document.querySelector('.add-more').addEventListener('click', function () {
        const container = document.getElementById('contribution-entries');
        const newIndex = document.querySelectorAll('.single-contribution').length;
        const html = `
            <div class="row mt-3 single-contribution">
                <div class="col-md-6 mb-3 bg-white p-3">
                    <label class="form-label">Amount</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" name="contributions[${newIndex}][amount]" class="form-control amount-input" required>
                    </div>
                    <label class="form-label mt-2">Fund</label>
                    <select name="contributions[${newIndex}][fund]" class="form-select" required>
                        <option selected>General Fund</option>
                        <option value="Missions Fund">Missions Fund</option>
                    </select>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    });
</script>
@endsection
