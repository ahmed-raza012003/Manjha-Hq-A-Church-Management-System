@extends('layouts.base')

@section('content')
<div class="container mt-5">
    <form action="{{ route('contributions.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Contributor and Anonymous -->
            <div class="col-md-6 mb-3 bg-white p-3">
                <label for="contributor" class="form-label">Contributor (Member) or Envelope Number</label>
                <select id="contributor" name="contributions[0][member_id]" class="form-select">
                    <option selected>Select</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </select>
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" name="contributions[0][anonymous]" id="anonymous">
                    <label class="form-check-label" for="anonymous">Anonymous</label>
                </div>
            </div>

            <!-- Payment Method and Date -->
            <div class="col-md-6 mb-3 bg-white p-3">
                <label for="paymentMethod" class="form-label">Payment Method</label>
                <select id="paymentMethod" name="contributions[0][payment_method]" class="form-select" required>
                    <option selected>Select</option>
                    <option value="Stripe">Stripe</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Cash App">Cash App</option>
                </select>
                <label for="date" class="form-label mt-2">Date</label>
                <input type="date" name="contributions[0][date]" id="date" class="form-control" required>
            </div>
        </div>

        <!-- Contribution Entries -->
        <div id="contribution-entries">
            <div class="row mt-3 single-contribution">
                <div class="col-md-6 mb-3 bg-white p-3">
                    <label for="amount" class="form-label">Amount</label>
                    <div class="input-group">
                        <span class="input-group-text">Rs.</span>
                        <input type="number" name="contributions[0][amount]" class="form-control amount-input" placeholder="0.00" required>
                    </div>
                    <label for="fund" class="form-label mt-2">Fund</label>
                    <select name="contributions[0][fund]" class="form-select" required>
                        <option selected>General Fund</option>
                        <option value="Missions Fund">Missions Fund</option>
                    </select>
                    <button type="button" class="btn btn-sm btn-custom mt-3 add-more">+ Add More</button>
                </div>

                <!-- Batch Summary -->
                <div class="col-md-6 mb-3 bg-white p-3">
                    <label for="batch" class="form-label">Batch</label>
                    <select id="batch" name="batch" class="form-select">
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
            <div>
                <button type="button" class="btn btn-outline-custom" id="viewBatch">View Batch</button>
                <button type="button" class="btn btn-outline-custom mx-3" id="createNew">Create New</button>
            </div>
            <button type="submit" class="btn custom-button-add">Add Contributions</button>
        </div>
    </form>
</div>

<!-- JavaScript -->
<script>
    let totalEntries = 1;

    // Add More Entry
    document.querySelector('.add-more').addEventListener('click', function () {
        const container = document.getElementById('contribution-entries');
        const newIndex = document.querySelectorAll('.single-contribution').length;
        const html = `
            <div class="row mt-3 single-contribution">
                <div class="col-md-6 mb-3 bg-white p-3">
                    <label for="amount" class="form-label">Amount</label>
                    <div class="input-group">
                        <span class="input-group-text">Rs.</span>
                        <input type="number" name="contributions[${newIndex}][amount]" class="form-control amount-input" placeholder="0.00" required>
                    </div>
                    <label for="fund" class="form-label mt-2">Fund</label>
                    <select name="contributions[${newIndex}][fund]" class="form-select" required>
                        <option selected>General Fund</option>
                        <option value="Missions Fund">Missions Fund</option>
                    </select>
                    <button type="button" class="btn btn-sm btn-danger mt-3 remove-contribution">Remove</button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        updateTotals();
    });

    // Remove Contribution Entry
    document.getElementById('contribution-entries').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-contribution')) {
            e.target.closest('.single-contribution').remove();
            updateTotals();
        }
    });

    // Update Totals
    document.getElementById('contribution-entries').addEventListener('input', function () {
        updateTotals();
    });

    function updateTotals() {
        const amounts = document.querySelectorAll('.amount-input');
        totalEntries = amounts.length;
        const totalAmount = Array.from(amounts).reduce((sum, input) => sum + parseFloat(input.value || 0), 0);

        document.getElementById('total-entries').textContent = totalEntries;
        document.getElementById('total-amount').textContent = totalAmount.toFixed(2);
    }
</script>
@endsection
