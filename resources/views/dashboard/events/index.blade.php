@extends('layouts.base')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
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
        color: #fff; 
        background-color: #5541D7; 
        border: 1px solid #5541D7; 
    }

    .btn-1:hover {
        background-color: #3f31a3;
        border-color: #3f31a3;
        color: #fff;
    }
</style>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Top Buttons -->
        <div>
            <button class="btn btn-1" data-bs-toggle="modal" data-bs-target="#createEventModal"><i class="bi bi-plus-circle"></i> Add Event</button>
           
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('events.index') }}" class="input-group w-50">
            <input type="text" name="search" class="form-control" placeholder="Search by Event Title, Date" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Number of Attendees</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                <tr>
                   
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->time }}</td>
                    <td>{{ $event->number_of_attendees }}</td>
                    <td>
                        <!-- Three-Dot Button -->
                        <button class="three-dot-btn" onclick="toggleActionMenu({{ $event->id }})">
                            <i class="bi bi-three-dots"></i>
                        </button>

                        <!-- Action Menu (Hidden by Default) -->
                        <div id="action-menu-{{ $event->id }}" class="dropdown-menu" style="display: none;">
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editEventModal" onclick="populateEditModal({{ $event }})">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
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
            Showing {{ $events->firstItem() }} to {{ $events->lastItem() }} of {{ $events->total() }} Events
        </div>
        {{ $events->links('pagination::bootstrap-4') }}
    </div>
</div>

<!-- Create Event Modal -->
<div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('events.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createEventModalLabel">Create Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Event Title -->
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="eventTitle" required>
                    </div>

                    <!-- Event Description -->
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="eventDescription" rows="4" required></textarea>
                    </div>

                    <!-- Event Date -->
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" id="eventDate" required>
                    </div>

                    <!-- Event Time -->
                    <div class="mb-3">
                        <label for="eventTime" class="form-label">Time</label>
                        <input type="time" name="time" class="form-control" id="eventTime" required>
                    </div>

                    <!-- Number of Attendees -->
                    <div class="mb-3">
                        <label for="eventAttendees" class="form-label">Number of Attendees</label>
                        <input type="number" name="number_of_attendees" class="form-control" id="eventAttendees" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Event Modal -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editEventForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editEventTitle" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="editEventTitle" required>
                    </div>

                    <div class="mb-3">
                        <label for="editEventDescription" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="editEventDescription" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="editEventDate" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" id="editEventDate" required>
                    </div>

                    <div class="mb-3">
                        <label for="editEventTime" class="form-label">Time</label>
                        <input type="time" name="time" class="form-control" id="editEventTime" required>
                    </div>

                    <div class="mb-3">
                        <label for="editEventAttendees" class="form-label">Number of Attendees</label>
                        <input type="number" name="number_of_attendees" class="form-control" id="editEventAttendees" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Event</button>
                </div>
            </form>
        </div>
    </div>
</div>




<script>
    function toggleActionMenu(eventId) {
        const menu = document.getElementById('action-menu-' + eventId);
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    function populateEditModal(event) {
        document.getElementById('editEventForm').action = '/events/' + event.id;
        document.getElementById('editEventTitle').value = event.title;
        document.getElementById('editEventDescription').value = event.description;
        document.getElementById('editEventDate').value = event.date;
        document.getElementById('editEventTime').value = event.time;
        document.getElementById('editEventAttendees').value = event.number_of_attendees;
    }
</script>
@endsection
