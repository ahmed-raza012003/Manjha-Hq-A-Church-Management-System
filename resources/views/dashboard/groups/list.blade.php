@extends('layouts.base')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    /* Add your existing styles */
    .custom-container {
        border-radius: 8px;
        background-color: #f8f9fa;
    }
    .input-group-text {
        background-color: #fff;
        border: 1px solid #ced4da;
    }
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

    .action-btn-container {
        position: relative;
    }

    /* Fix alignment of search button to the right of the input field */
    .input-group {
        width: 100%;
        max-width: 350px;
    }

    .input-group .btn-outline-secondary {
        border-radius: 0 8px 8px 0;
    }
    .table-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.d-flex.align-items-center span {
    font-size: 14px;
    font-weight: 500;
    margin-left: 10px; /* Add spacing between the image and name */
}
td {
    white-space: nowrap; /* Prevent text wrapping */
    overflow: hidden;
    text-overflow: ellipsis; /* Add ellipsis for overflowing text */
}
</style>

<div class="container">
    <div class="row">
        <div class="col d-flex justify-content-between align-items-center custom-container">
            <!-- Add Group Button -->
            <button class="btn btn-custom d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                <i class="bi bi-person-plus me-2"></i>Create Group
            </button>

            <!-- Search Input with Button aligned properly to the right -->
            <div class="input-group w-auto">
                <form action="{{ route('groups.index') }}" method="GET" style="display: flex; width: 100%;">
                    <input type="text" class="form-control" name="search" placeholder="Search by name" value="{{ request()->get('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search" style="color: #5541D7;"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Create Group Modal -->
<div class="modal fade" id="createGroupModal" tabindex="-1" aria-labelledby="createGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createGroupModalLabel">Create New Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('groups.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="groupName" class="form-label">Group Name</label>
                        <input type="text" class="form-control" id="groupName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="groupImage" class="form-label">Group Image</label>
                        <input type="file" class="form-control" id="groupImage" name="image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="groupDescription" class="form-label">Group Description</label>
                        <textarea class="form-control" id="groupDescription" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-custom w-100">Create Group</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGroupModalLabel">Edit Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editGroupForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editGroupName" class="form-label">Group Name</label>
                        <input type="text" class="form-control" id="editGroupName" name="name" required>
                    </div>

                    <!-- Group Image Preview & Upload -->
                    <div class="mb-3">
                        <label for="groupImage" class="form-label">Update Group Image</label>
                        <input type="file" class="form-control" id="groupImage" name="image" accept="image/*">
                        <img id="groupImagePreview" class="mt-2" style="width: 100px;" src="" alt="Group Image Preview">
                    </div>

                    <div class="mb-3">
                        <label for="editGroupDescription" class="form-label">Group Description</label>
                        <textarea class="form-control" id="editGroupDescription" name="description"></textarea>
                    </div>

                    <button type="submit" class="btn btn-custom w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Send Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Select Message Type -->
                <div class="mt-3">
                    <label>Select Message Type:</label>
                    <select id="msgTypeSelector" class="form-control" onchange="updateMessageType()">
                        <option value="text">Text</option>
                        <option value="voice">Voice</option>
                        <option value="video">Video</option>
                    </select>
                </div>

                <!-- Dynamic Message Input Area -->
                <div class="msg-type-input mt-3" id="msg-text">
                    <textarea class="form-control" rows="3" placeholder="Enter your message..."></textarea>
                </div>
                <div class="msg-type-input mt-3" id="msg-voice" style="display:none;">
                    <input type="file" class="form-control" accept="audio/*">
                </div>
                <div class="msg-type-input mt-3" id="msg-video" style="display:none;">
                    <input type="file" class="form-control" accept="video/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</div>

<!-- Group Table -->
<div class="container mt-3">
    <div class="d-flex justify-content-between">
        <div>
            <button class="btn btn-sm buttons" id="select-all-btn">
                Select All
            </button>
            <button class="btn btn-sm buttons" onclick="openMessageModal('text')" id="text-btn">
                <i class="far fa-comment"></i> Text
            </button>
            <button class="btn btn-sm buttons" onclick="openMessageModal('voice')" id="email-btn">
                <i class="far fa-envelope"></i> Mail
            </button>
            <button class="btn btn-sm buttons" onclick="openMessageModal('video')" id="whatsapp-btn">
                <i class="fab fa-whatsapp"></i> Whatsapp
            </button>
        </div>
        <div>
            <a href="{{ route('groups.export') }}" class="btn btn-sm button-outlined">
                <i class="fas fa-download me-1"></i> Export
            </a>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light text-muted">
                <tr>
                    <th scope="col"><input type="checkbox"></th>
                    <th scope="col">GROUP NAME</th>
                    <th scope="col">VISIBILITY</th>
                    <th scope="col">MEMBERS</th>
                    <th scope="col">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($groups as $group)
    <tr>
        <td><input type="checkbox"></td>
        <!-- Group Image & Name Column -->
        <td class="d-flex align-items-center">
            <img src="{{ asset('storage/' . $group->image) }}" class="table-img me-2" alt="Group Image">
            <div>
                <strong>{{ $group->name }}</strong>
            </div>
        </td>
        <!-- Visibility Column (Display "Members") -->
        <td>Members</td>
        <!-- Members Column (Dynamic Member Count) -->
        <td>{{ $group->members_count }}</td>  <!-- Display the dynamically calculated member count -->
        <td class="action-btn-container">
            <!-- Three Dots Button for Action Menu -->
            <button class="three-dot-btn" onclick="toggleActionMenu({{ $group->id }})">
                <i class="bi bi-three-dots"></i>
            </button>
            <!-- Action Menu -->
            <div id="action-menu-{{ $group->id }}" class="dropdown-menu">
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editGroupModal" onclick="populateEditModal({{ $group }})">
                    <i class="bi bi-pencil"></i> Edit
                </a>

                <form action="{{ route('groups.destroy', $group->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item ">
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

    <div class="d-flex justify-content-between align-items-center">
        <nav>
            <ul class="pagination mb-0">
                {{ $groups->links() }}
            </ul>
        </nav>
        <span class="pagination-summary">{{ $groups->firstItem() }} - {{ $groups->lastItem() }} of {{ $groups->total() }} Groups</span>
    </div>
</div>


<script>
    // Toggle action menu for groups
    function toggleActionMenu(groupId) {
        const menu = document.getElementById('action-menu-' + groupId);
        // Close all menus
        const allMenus = document.querySelectorAll('.dropdown-menu');
        allMenus.forEach(m => {
            if (m !== menu) {
                m.classList.remove('d-block');
            }
        });
        // Toggle current menu
        menu.classList.toggle('d-block');
    }

    // Close all action menus if clicked outside
    window.addEventListener('click', function(event) {
        if (!event.target.closest('.action-btn-container')) {
            const allMenus = document.querySelectorAll('.dropdown-menu');
            allMenus.forEach(menu => menu.classList.remove('d-block'));
        }
    });

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

    // Open message modal with selected message type
    function openMessageModal(msgType) {
        const modal = new bootstrap.Modal(document.getElementById('messageModal'));
        modal.show();

        // Reset message area visibility
        document.querySelectorAll('.msg-type-input').forEach(input => input.style.display = 'none');
        
        // Show selected message type
        if (msgType === 'text') {
            document.getElementById('msg-text').style.display = 'block';
        } else if (msgType === 'voice') {
            document.getElementById('msg-voice').style.display = 'block';
        } else if (msgType === 'video') {
            document.getElementById('msg-video').style.display = 'block';
        }
    }

    function updateMessageType() {
        const msgType = document.getElementById('msgTypeSelector').value;
        document.querySelectorAll('.msg-type-input').forEach(input => input.style.display = 'none');
        document.getElementById('msg-' + msgType).style.display = 'block';
    }

     // Populate the Edit Group Modal with dynamic group details
     function populateEditModal(group) {
        const form = document.getElementById('editGroupForm');
        form.action = `/groups/${group.id}`; // Set the form action to the correct URL for the group

        // Set the group name and description dynamically
        document.getElementById('editGroupName').value = group.name; 
        document.getElementById('editGroupDescription').value = group.description;

        // Set the group image preview if available
        if (group.image) {
            document.getElementById('groupImagePreview').src = '/storage/' + group.image;
        } else {
            document.getElementById('groupImagePreview').src = 'default-image.jpg'; // Set a default image if none exists
        }
    }
</script>

@endsection
