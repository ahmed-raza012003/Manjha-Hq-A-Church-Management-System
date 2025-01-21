@extends('layouts.base')
@section('content')

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

<div class="container mt-4">
    <div class="row">
        <!-- Side Navigation -->
        <div class="col-md-3">
            <ul class="side-nav">
                <li class="active" data-section="personal-info">1. Personal Info</li>
                <li data-section="other-details">2. Other Details</li>
                <li data-section="address">3. Address</li>
                <li data-section="employment">4. Employment</li>
            </ul>
        </div>

        <!-- Form Section -->
        <div class="col-md-9">
            <form id="memberForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="PUT">

                <!-- Personal Info -->
                <div id="personal-info" class="section active">
                    <h5>1. Personal Info</h5>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control required" value="{{ old('first_name', $member->first_name) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $member->middle_name) }}">
                    </div>
                    <div class="form-group">
                        <label>Nick Name</label>
                        <input type="text" name="nick_name" class="form-control" value="{{ old('nick_name', $member->nick_name) }}">
                    </div>
                    <div class="form-group">
                        <label>Picture</label>
                        <input type="file" name="picture" class="form-control-file">
                        @if($member->picture)
                            <img src="{{ asset('storage/' . $member->picture) }}" alt="Profile Picture" class="mt-2" style="width: 100px;">
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control required" required>
                            <option value="Male" {{ $member->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $member->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ $member->gender == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control required" value="{{ old('date_of_birth', $member->date_of_birth) }}" required>
                    </div>
                </div>

                <!-- Other Details -->
                <div id="other-details" class="section">
                    <h5>2. Other Details</h5>
                    <div class="form-group">
    <label for="groups">Groups</label>
    <select name="groups" class="form-control required" required>
        <option value="">Select a group</option>
        @foreach($groups as $group)
            <option value="{{ $group->id }}" {{ (old('groups', $member->groups) == $group->id) ? 'selected' : '' }}>
                {{ $group->name }}  <!-- Assuming 'name' is the column that holds the group name -->
            </option>
        @endforeach
    </select>
</div>

                    <div class="form-group">
                        <label>Baptism Date</label>
                        <input type="date" name="baptism_date" class="form-control required" value="{{ old('baptism_date', $member->baptism_date) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Member Status</label>
                        <select name="member_status" class="form-control required" required>
                            <option value="Active" {{ $member->member_status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $member->member_status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Address -->
                <div id="address" class="section">
                    <h5>3. Address</h5>
                    <div class="form-group">
                        <label>Full Address</label>
                        <input type="text" name="address" class="form-control required" value="{{ old('address', $member->address) }}" required>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" class="form-control required" value="{{ old('city', $member->city) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control required" value="{{ old('email', $member->email) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" class="form-control required" value="{{ old('phone_number', $member->phone_number) }}" required>
                    </div>
                </div>

                <!-- Employment -->
                <div id="employment" class="section">
                    <h5>4. Employment</h5>
                    <div class="form-group">
                        <label>Job Title</label>
                        <input type="text" name="job_title" class="form-control" value="{{ old('job_title', $member->job_title) }}">
                    </div>
                    <div class="form-group">
                        <label>Employer</label>
                        <input type="text" name="employer" class="form-control" value="{{ old('employer', $member->employer) }}">
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="button-group">
                    <button type="button" class="btn btn-save-draft" id="saveDraft">Save as Draft</button>
                    <button type="button" class="btn btn-custom" id="nextSection">Next</button>
                    <button type="submit" class="btn btn-custom" id="submitForm" style="display: none;">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Form Navigation
    document.querySelectorAll('.side-nav li').forEach(item => {
        item.addEventListener('click', () => {
            document.querySelectorAll('.side-nav li').forEach(nav => nav.classList.remove('active'));
            document.querySelectorAll('.section').forEach(section => section.classList.remove('active'));
            item.classList.add('active');
            document.getElementById(item.dataset.section).classList.add('active');
        });
    });

    document.getElementById('nextSection').addEventListener('click', () => {
        const current = document.querySelector('.section.active');
        const next = current.nextElementSibling;

        if (next && next.classList.contains('section')) {
            document.querySelectorAll('.section').forEach(section => section.classList.remove('active'));
            next.classList.add('active');

            const index = Array.from(document.querySelectorAll('.section')).indexOf(next);
            document.querySelectorAll('.side-nav li').forEach(nav => nav.classList.remove('active'));
            document.querySelectorAll('.side-nav li')[index].classList.add('active');
        }

        checkFields();
    });

    function checkFields() {
        const requiredFields = document.querySelectorAll('.required');
        let allFilled = true;

        requiredFields.forEach(field => {
            if (!field.value) allFilled = false;
        });

        const submitButton = document.getElementById('submitForm');
        if (allFilled) {
            submitButton.style.display = 'inline-block';
        } else {
            submitButton.style.display = 'none';
        }
    }

    // Save Draft Button
    document.getElementById('saveDraft').addEventListener('click', () => {
        const form = document.getElementById('memberForm');
        form.action = '{{ route("members.updateDraft", $member->id) }}';
        form.submit();
    });

    // On Input Check Fields
    document.querySelectorAll('.required').forEach(field => {
        field.addEventListener('input', checkFields);
    });

    checkFields(); // Initial check
</script>

@endsection
