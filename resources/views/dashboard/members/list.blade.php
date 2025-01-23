@extends('layouts.base')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
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
            <!-- Add Person Button -->
            <button class="btn btn-custom d-flex align-items-center" onclick="window.location='{{ route('members.create') }}'">
                <i class="bi bi-person-plus me-2"></i> Add Person
            </button>

            <!-- Search Input with Button aligned properly to the right -->
            <div class="input-group w-auto">
                <form action="{{ route('members.index') }}" method="GET" style="display: flex; width: 100%;">
                    <input type="text" class="form-control" name="search" placeholder="Search by name, Email, Number" value="{{ request()->get('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search" style="color: #5541D7;"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Send Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Select Members for Sending Messages -->
               

                <!-- Message Type Selector -->
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


<div class="container mt-3">
    <div class="d-flex justify-content-between">
        <div>
            <button class="btn btn-sm buttons" id="select-all-btn">
                Select All
            </button>
            <button class="btn btn-sm buttons" data-bs-toggle="modal" data-bs-target="#smsModal" id="text-btn">
                <i class="far fa-comment"></i> Text
            </button>
            <button 
    class="btn btn-sm buttons" 
    data-bs-toggle="modal" 
    data-bs-target="#emailModal" 
    id="email-btn">
    <i class="far fa-envelope"></i> Mail
</button>

            <button class="btn btn-sm buttons" data-bs-toggle="modal" data-bs-target="#messageModal" id="whatsapp-btn">
                <i class="fab fa-whatsapp"></i> Whatsapp
            </button>
        </div>
        <div>
        <a href="{{ route('members.export') }}" class="btn btn-sm button-outlined">
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
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">Phone</th>
                    <th scope="col">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                <tr>
                <td><input type="checkbox" class="member-checkbox" value="{{ $member->id }}"></td>
                   
                    <td>
    <div class="d-flex align-items-center">
        <img 
            src="{{ $member->picture ? asset('storage/' . $member->picture) : 'https://via.placeholder.com/40' }}" 
            alt="User Photo" 
            class="table-img me-2"
        >  
        <span>{{ $member->first_name }}</span>
    </div>
</td>

                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone_number }}</td>
                    <td class="action-btn-container">
                        <!-- Three Dots Button for Action Menu -->
                        <button class="three-dot-btn" onclick="toggleActionMenu({{ $member->id }})">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <!-- Action Menu -->
                        <div id="action-menu-{{ $member->id }}" class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('members.edit', $member->id) }}">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;">
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
                {{ $members->links() }}
            </ul>
        </nav>
        <span class="pagination-summary">{{ $members->firstItem() }} - {{ $members->lastItem() }} of {{ $members->total() }} Members</span>
    </div>
</div>
<!-- emailmodal  -->
<!-- Email Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">Send Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="emailForm" action="{{ route('sendEmail') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Select Members for Sending Emails -->
                    <div class="mb-3">
    <label for="recipientType">Recipient:</label>
    <select id="recipientType" name="recipientType" class="form-control">
        <option value="all">All Members</option>
        <option value="selected">Selected Members</option>
    </select>
</div>
<div class="mb-3" id="selectedMembersContainer" style="display: none;">
    <label for="selectedMembers">Selected Members:</label>
    <select id="selectedMembers" name="selectedMembers[]" class="form-control" multiple>
        <!-- Options will be dynamically added -->
    </select>
</div>

                    <div class="mb-3">
                        <label for="subject">Subject:</label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter email subject" required>
                    </div>
                    <!-- Message Type Selector -->
                    <div class="mb-3">
                        <label for="msgType">Message Type:</label>
                        <select id="msgType" name="msgType" class="form-control" onchange="updateEmailMessageType()">
                            <option value="text">Text</option>
                            <option value="voice">Voice</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
                    <!-- Dynamic Message Input Area -->
                    <div class="email-msg-type mt-3" id="email-text">
                        <textarea class="form-control" name="message" rows="4" placeholder="Enter your message..." required></textarea>
                    </div>
                    <div class="email-msg-type mt-3" id="email-voice" style="display: none;">
                        <input type="file" name="voice" class="form-control" accept="audio/*">
                    </div>
                    <div class="email-msg-type mt-3" id="email-video" style="display: none;">
                        <input type="file" name="video" class="form-control" accept="video/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Email</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- sms  -->
<div class="modal fade" id="smsModal" tabindex="-1" aria-labelledby="smsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smsModalLabel">Send SMS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Member Selection Area -->
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAllMembers">
                        <label class="form-check-label" for="selectAllMembers">
                            Select All Members
                        </label>
                    </div>
                    <div class="member-selection" style="max-height: 200px; overflow-y: auto;">
                        @foreach ($members as $member)
                        <div class="form-check">
                            <input 
                                class="form-check-input member-checkbox" 
                                type="checkbox" 
                                value="{{ $member->id }}" 
                                id="member{{ $member->id }}"
                            >
                            <label class="form-check-label" for="member{{ $member->id }}">
                                {{ $member->first_name }} ({{ $member->phone_number }})
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- SMS Message Input -->
                <div class="mt-3">
                    <textarea 
                        id="smsMessageInput" 
                        class="form-control" 
                        rows="3" 
                        placeholder="Type your SMS message..."
                    ></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="sendSMS()">Send SMS</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAllMembers');
    const memberCheckboxes = document.querySelectorAll('.member-checkbox');

    selectAllCheckbox.addEventListener('change', function() {
        memberCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });
});

function sendSMS() {
    const selectedMembers = Array.from(document.querySelectorAll('.member-checkbox:checked'))
        .map(checkbox => checkbox.value);
    
    const message = document.getElementById('smsMessageInput').value.trim();

    if (selectedMembers.length === 0) {
        alert('Please select at least one recipient');
        return;
    }

    if (!message) {
        alert('Please enter an SMS message');
        return;
    }

    fetch('{{ route('send.sms') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            message: message,
            recipients: selectedMembers
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Use vanilla JS to close modal
            const smsModal = document.getElementById('smsModal');
            const modalInstance = bootstrap.Modal.getInstance(smsModal);
            if (modalInstance) {
                modalInstance.hide();
            }
        } else {
            alert('Failed to send SMS: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while sending SMS: ' + error.message);
    });
}
</script>
<script>
    function updateEmailMessageType() {
    const msgType = document.getElementById('msgType').value;
    document.querySelectorAll('.email-msg-type').forEach(input => input.style.display = 'none');
    document.getElementById('email-' + msgType).style.display = 'block';
}
document.addEventListener('DOMContentLoaded', function () {
    const recipientType = document.getElementById('recipientType');
    const selectedMembersContainer = document.getElementById('selectedMembersContainer');
    const selectedMembersDropdown = document.getElementById('selectedMembers');
    const memberCheckboxes = document.querySelectorAll('.member-checkbox');

    // Show/hide the selected members dropdown based on recipient type
    recipientType.addEventListener('change', function () {
        if (this.value === 'selected') {
            selectedMembersContainer.style.display = 'block';
            populateSelectedMembers();
        } else {
            selectedMembersContainer.style.display = 'none';
            selectedMembersDropdown.innerHTML = ''; // Clear previous options
        }
    });

    // Populate selected members in the dropdown
    function populateSelectedMembers() {
        selectedMembersDropdown.innerHTML = ''; // Clear existing options
        memberCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const memberId = checkbox.value;
                const memberName = checkbox.closest('tr').querySelector('td:nth-child(2) span').innerText; // Get name from table
                const option = document.createElement('option');
                option.value = memberId;
                option.textContent = memberName;
                selectedMembersDropdown.appendChild(option);
            }
        });

        if (selectedMembersDropdown.options.length === 0) {
            // If no members are selected, show a placeholder
            const placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.textContent = 'No members selected';
            placeholder.disabled = true;
            selectedMembersDropdown.appendChild(placeholder);
        }
    }
});
document.addEventListener('DOMContentLoaded', function () {
    const emailForm = document.getElementById('emailForm');
    const recipientType = document.getElementById('recipientType');
    const selectedMembersContainer = document.getElementById('selectedMembersContainer');
    const selectedMembersDropdown = document.getElementById('selectedMembers');
    const memberCheckboxes = document.querySelectorAll('.member-checkbox');

    // Modify form submission to handle recipient selection
    emailForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let selectedMembers = [];
        
        if (recipientType.value === 'selected') {
            // Collect selected members from checkboxes
            memberCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedMembers.push(checkbox.value);
                }
            });

            // Validate selection
            if (selectedMembers.length === 0) {
                alert('Please select at least one member');
                return;
            }
        } else {
            // For 'all' type, get all member IDs
            selectedMembers = Array.from(memberCheckboxes).map(checkbox => checkbox.value);
        }

        // Create FormData object
        const formData = new FormData(emailForm);
        formData.delete('selectedMembers'); // Remove existing entries
        
        // Append selected member IDs
        selectedMembers.forEach(memberId => {
            formData.append('selectedMembers[]', memberId);
        });

        // Send AJAX request
        fetch(emailForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Emails sent successfully to ${data.recipients_count} recipients`);
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('emailModal'));
                modal.hide();
            } else {
                alert('Failed to send emails: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while sending emails');
        });
    });

    // Existing recipient type change logic
    recipientType.addEventListener('change', function () {
        if (this.value === 'selected') {
            selectedMembersContainer.style.display = 'block';
        } else {
            selectedMembersContainer.style.display = 'none';
        }
    });
});
    function toggleActionMenu(memberId) {
        const menu = document.getElementById('action-menu-' + memberId);
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

    document.addEventListener('DOMContentLoaded', function () {
    const selectAllBtn = document.getElementById('select-all-btn'); // Button to select all members
    const masterCheckbox = document.querySelector('thead input[type="checkbox"]'); // Master checkbox in table header
    const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]'); // All individual member checkboxes

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

function openMessageModal(msgType) {
        const modal = new bootstrap.Modal(document.getElementById('messageModal'));
        modal.show();

        // Reset message area visibility
        document.querySelectorAll('.msg-type-input').forEach(input => input.style.display = 'none');
        
        // Show selected message type
        document.getElementById('msg-' + msgType).style.display = 'block';
    }

    function toggleSelectAll() {
        const checkboxes = document.querySelectorAll('.member-checkbox');
        const selectAllCheckbox = document.getElementById('select-all');
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }

    function updateMessageType() {
        const msgType = document.getElementById('msgTypeSelector').value;
        document.querySelectorAll('.msg-type-input').forEach(input => input.style.display = 'none');
        document.getElementById('msg-' + msgType).style.display = 'block';
    }
</script>

@endsection
