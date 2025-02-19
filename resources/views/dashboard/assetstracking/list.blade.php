@extends('layouts.base')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .status-label {
        padding: 0.3em 0.6em;
        border-radius: 5px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    .status-scheduled { background-color: #E0E7FF; color: #3730A3; }
    .status-active { background-color: #D1FAE5; color: #065F46; }
    .status-draft { background-color: #FEF3C7; color: #92400E; }
    .pagination-info { font-size: 0.875rem; color: #6B7280; }
    .dropdown-menu {
        position: absolute;
        top: 10;
        right: 0;
        left: 10;
        display: block;
        margin-top: 10px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0,0,0,.2);
        z-index: 1;
        display: none;
    }

    .dropdown-item {
        /* padding: 10px; */
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
    .btn-1 {
    color: #fff; /* White text */
    background-color: #5541D7; /* Purple background */
    border: 1px solid #5541D7; /* Purple border */
}

.btn-1:hover {
    background-color: #3f31a3; /* Darker purple for hover effect */
    border-color: #3f31a3;
    color: #fff; /* White text */
}

</style>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Top Buttons -->
        <div>
            <button  class="btn btn-1"  data-bs-toggle="modal" data-bs-target="#createAssetModal"><i class="bi bi-plus-circle"></i> Add Asset</button>
            <button class="btn btn-1" id="select-all-btn">
                Select All
            </button>
            <a href="{{ route('assets.export') }}" class="btn btn-outline-secondary">
    <i class="bi bi-upload"></i> Export
</a>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('assets.index') }}" class="input-group w-50">
            <input type="text" name="search" class="form-control" placeholder="Search by Asset name, Type, Status" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>ID</th>
                    <th>Asset</th>
                    
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assets as $asset)
                <tr>
  
                <td><input type="checkbox" class="selectItem" value="{{ $asset->id }}"></td>
                <td> {{ $asset-> asset_id }}</td>

                <td class="d-flex align-items-center">
                        <img src="{{ asset('storage/' . $asset->image) }}" alt="Asset" style="width: 50px; height: 50px; object-fit: cover;" class="me-3">
                        {{ $asset->name }}
                       
                    </td>
                    <td>{{ $asset->category }}</td>
                    <td>${{ number_format($asset->price, 2) }}</td>
                    <td>{{ $asset->stock }}</td>
                    <td>
                        <span class="status-label status-{{ strtolower($asset->status) }}">{{ $asset->status }}</span>
                    </td>
                    <td>
                   <!-- Three-Dot Button -->
<button class="three-dot-btn" onclick="toggleActionMenu({{ $asset->id }})">
    <i class="bi bi-three-dots"></i>
</button>

<!-- Action Menu (Hidden by Default) -->
<div id="action-menu-{{ $asset->id }}" class="dropdown-menu" style="display: none;">
    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editAssetModal" onclick="populateEditModal({{ $asset }})">
        <i class="bi bi-pencil"></i> Edit
    </a>

    <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="dropdown-item">
            <i class="bi bi-trash"></i> Delete
        </button>
    </form>
</div>


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center">
        <div class="pagination-info">
            Showing {{ $assets->firstItem() }} to {{ $assets->lastItem() }} of {{ $assets->total() }} Items
        </div>
        {{ $assets->links('pagination::bootstrap-4') }}
    </div>
</div>

<!-- Create Asset Modal -->
<div class="modal fade" id="createAssetModal" tabindex="-1" aria-labelledby="createAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="church_name" value="{{ auth()->user()->church_name }}">

                <div class="modal-header">
                    <h5 class="modal-title" id="createAssetModalLabel">Create Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 <!-- Asset Name -->
<div class="mb-3">
    <label for="assetName" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="assetName" required>
</div>

<!-- Asset ID (Changed from 'name' to 'asset_id') -->
<div class="mb-3">
    <label for="asset_id" class="form-label">Asset ID</label>
    <input type="text" name="asset_id" class="form-control" id="asset_id" required>
</div>

                    <div class="mb-3">
                        <label for="assetCategory" class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" id="assetCategory" required>
                    </div>
                    <div class="mb-3">
                        <label for="assetPrice" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="assetPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="assetStock" class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" id="assetStock" required>
                    </div>
                    <div class="mb-3">
                        <label for="assetStatus" class="form-label">Status</label>
                        <select name="status" class="form-select" id="assetStatus" required>
                            <option value="Scheduled">Scheduled</option>
                            <option value="Active">Active</option>
                            <option value="Draft">Draft</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="assetImage" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="assetImage" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Asset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Asset Modal -->
<div class="modal fade" id="editAssetModal" tabindex="-1" aria-labelledby="editAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editAssetForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editAssetModalLabel">Edit Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editAssetName" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="editAssetName" required>
                    </div>
                    <div class="mb-3">
    <label for="editAssetId" class="form-label">Asset ID</label>
    <input type="text" name="asset_id" class="form-control" id="editAssetId" required>
</div>

                    <div class="mb-3">
                        <label for="editAssetCategory" class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" id="editAssetCategory" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAssetPrice" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="editAssetPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAssetStock" class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" id="editAssetStock" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAssetStatus" class="form-label">Status</label>
                        <select name="status" class="form-select" id="editAssetStatus" required>
                            <option value="Scheduled">Scheduled</option>
                            <option value="Active">Active</option>
                            <option value="Draft">Draft</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editAssetImage" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="editAssetImage">
                        <img id="editAssetImagePreview" src="#" alt="Preview" class="img-fluid mt-3" style="max-height: 150px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Asset</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
     // Selecting All Groups
     document.addEventListener('DOMContentLoaded', function () {
        const selectAllBtn = document.getElementById('select-all-btn'); // Button to select all groups
        const masterCheckbox = document.querySelector('thead input[type="checkbox"]'); // Master checkbox in table header
        const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]'); // All individual group checkboxes

        // Function to toggle all checkboxes
        function toggleCheckboxes(checked) {
            checkboxes.forEach(checkbox => {
                checkbox.checked = checked;
            });
        }

        // Handle the "Select All" button
        selectAllBtn.addEventListener('click', function () {
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
            toggleCheckboxes(!allChecked); // Toggle all checkboxes
            masterCheckbox.checked = !allChecked; // Update master checkbox state
        });

        // Handle the master checkbox
        masterCheckbox.addEventListener('change', function () {
            toggleCheckboxes(this.checked);
        });

        // Update master checkbox state based on individual checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                const noneChecked = Array.from(checkboxes).every(cb => !cb.checked);

                // Update master checkbox state
                masterCheckbox.checked = allChecked;
                masterCheckbox.indeterminate = !allChecked && !noneChecked;
            });
        });
    });


    // Populate Edit Modal
    function populateEditModal(asset) {
        const form = document.getElementById('editAssetForm');
        form.action = `/assets/${asset.id}`;
        document.getElementById('editAssetName').value = asset.name;
        document.getElementById('editAssetId').value = asset.asset_id; // Populate the asset_id field

        document.getElementById('editAssetCategory').value = asset.category;
        document.getElementById('editAssetPrice').value = asset.price;
        document.getElementById('editAssetStock').value = asset.stock;
        document.getElementById('editAssetStatus').value = asset.status;
        document.getElementById('editAssetImagePreview').src = asset.image ? `/storage/${asset.image}` : '';
    }

    // Toggle the action menu visibility
    function toggleActionMenu(assetId) {
        var menu = document.getElementById('action-menu-' + assetId);
        menu.classList.toggle('d-block'); // Toggle the 'd-block' class to show/hide menu
    }
</script>

@endsection
