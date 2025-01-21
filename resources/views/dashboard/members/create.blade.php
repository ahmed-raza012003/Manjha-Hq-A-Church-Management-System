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
        background-color:rgb(255, 255, 255);
        color:#5541D7;
        border: 1px solid #5541D7;
    }

    .btn-save-draft {
        background-color:rgb(255, 255, 255);
        color:#5541D7;
        border: 1px solid #5541D7;
    }

    .btn-save-draft:hover {
        background-color:#5541D7;
        color:white;
        
        
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
            <form id="memberForm" action="{{ route('members.saveDraft') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Personal Info -->
                <div id="personal-info" class="section active">
                    <h5>1. Personal Info</h5>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nick Name</label>
                        <input type="text" name="nick_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Picture</label>
                        <input type="file" name="picture" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" required>
                    </div>
                </div>

                <!-- Other Details -->
                <div id="other-details" class="section">
                    <h5>2. Other Details</h5>
                    <div class="form-group">
    <label for="group_id">Groups</label>
    <select name="group_id" class="form-control required" required>
        <option value="">Select a group</option>
        @foreach($groups as $group)
            <option value="{{ $group->id }}" >
                {{ $group->name }}  <!-- Assuming 'name' is the column that holds the group name -->
            </option>
        @endforeach
    </select>
</div>

                    <div class="form-group">
                        <label>Baptism Date</label>
                        <input type="date" name="baptism_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Member Status</label>
                        <select name="member_status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Address -->
                <div id="full_address" class="section">
                    <h5>3. Address</h5>
                    <div class="form-group">
                        <label>Full Address</label>
                        <input type="text" name="ful_address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" required>
                    </div>
                </div>

                <!-- Employment -->
                <div id="employment" class="section">
                    <h5>4. Employment</h5>
                    <div class="form-group">
                        <label>Job Title</label>
                        <input type="text" name="job_title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Employer</label>
                        <input type="text" name="employer" class="form-control">
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="button-group">
                    <button type="button" class="btn btn-save-draft" id="saveDraft">Save as Draft</button>
                    <button type="button" class="btn btn-custom" id="nextSection">Next</button>
                    <button type="submit" class="btn btn-custom" id="submitForm" style="display:none;">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.side-nav li').forEach(item => {
        item.addEventListener('click', () => {
            // Remove active class from all
            document.querySelectorAll('.side-nav li').forEach(nav => nav.classList.remove('active'));
            document.querySelectorAll('.section').forEach(section => section.classList.remove('active'));

            // Add active class to the clicked item and corresponding section
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
    });

    document.getElementById('saveDraft').addEventListener('click', () => {
        document.getElementById('memberForm').action = '{{ route('members.saveDraft') }}';
        document.getElementById('memberForm').submit();
    });

    document.getElementById('submitForm').addEventListener('click', () => {
        document.getElementById('memberForm').action = '{{ route('members.store') }}';
    });

    // Dynamically show the submit button if all fields are filled
    const formInputs = document.querySelectorAll('input, select');
    formInputs.forEach(input => {
        input.addEventListener('input', checkFormValidity);
    });

    function checkFormValidity() {
        let allFilled = true;
        formInputs.forEach(input => {
            if (input.required && !input.value) {
                allFilled = false;
            }
        });

        if (allFilled) {
            document.getElementById('submitForm').style.display = 'inline-block';
            document.getElementById('saveDraft').style.display = 'none';
        } else {
            document.getElementById('submitForm').style.display = 'none';
            document.getElementById('saveDraft').style.display = 'inline-block';
        }
    }
</script>

@endsection
