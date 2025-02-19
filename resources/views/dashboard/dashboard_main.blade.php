@extends('layouts.base')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<style>
  /* body {
    font-family: "Work Sans", sans-serif;
    font-family: "Mulish", sans-serif;
  } */
  .box {
    background-color: white; /* Color from the image */
    color: #5541d7; /* Text color */
    padding: 20px 25px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px 0;
    text-align: center;
    /* height: 180px; */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-size: 18px;
  }

  .box .number {
    font-size: 36px; /* Larger size for the number */
    font-weight: bold;
  }

  .box p {
    font-size: 14px; /* Smaller text for the paragraph */
    margin-top: 10px;
  }

  /* Responsive Design: Mobile-first approach */
  @media (max-width: 576px) {
    .box {
      margin-bottom: 15px;
      height: 150px; /* Slightly smaller height on smaller screens */
    }
  }

  /* Custom media queries for tablets and below */
  @media (max-width: 768px) {
    .col-md-2 {
      flex: 0 0 50%;
      max-width: 50%;
    }
  }

  .custom-card {
    background-color: white;
    border: 1px solid #ffffff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  .custom-card-header {
    background-color: #ffffff;
    padding: 15px 20px 0px 20px;
    color: #5541d7;
  }
  .custom-card-header h2 {
    font-weight: 800;
  }
  .custom-card-body {
    padding: 0px 20px;
  }
  .custom-card-footer {
    background-color: #ffffff;
    color: #5541d7;
    padding: 0px 20px;
    text-align: left;
    font-weight: 700;
  }

  .event-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            background-color: #ffffff;
        }
        .event-card .event-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .event-card .event-header h3 {
            font-size: 1.3rem;
            margin: 0;
            font-weight: 600;
            color: #4c6ef5;
        }
        .event-card .event-header .icon {
            font-size: 1.5rem;
            color: #5541D7;
        }
        .event-card .event-body {
            font-size: .8rem;
            color: #6e6e6e;
            
        }
        .event-body p{
            font-size: .8rem;
            line-height: .8rem;
        }
        .event-card .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
        }
        .event-card .event-footer .date-time {
            color: #5541D7;
            font-weight: 700;
            margin-bottom: 14px;
        }
        .attended {
            color: #777;
            margin-bottom: 14px;
        }
         .checkin-btn {
            background-color: #5541D7;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 20px;
            cursor: pointer;
        }
        .event-card .event-footer .checkin-btn:hover {
            background-color: #3751ff;
        }
</style>


@if (Auth::user()->hasRole('super admin'))
  <!-- Content visible only to superadmin -->

<div class="container my-4">
  <div class="container my-4">
    <div class="row">
      <!-- Box 1 (Groups) -->
      <div class="col-6 col-md-3">
        <div class="box">
          <div class="number">{{ $groupsCount }}</div>
          <p>Groups Created</p>
          <h4 class="{{ $maxGroups !== null && ($maxGroups - $groupsCount) <= 0 ? 'text-danger' : '' }}">
            {{ $maxGroups !== null ? $maxGroups - $groupsCount : 'Unlimited' }}
          </h4>
          <p>Groups Remaining</p>
        </div>
      </div>
  
      <!-- Box 2 (Members) -->
      <div class="col-6 col-md-3">
        <div class="box">
          <div class="number">{{ $membersCount }}</div>
          <p>Members Added</p>
          <h4 class="{{ $maxMembers !== null && ($maxMembers - $membersCount) <= 0 ? 'text-danger' : '' }}">
            {{ $maxMembers !== null ? $maxMembers - $membersCount : 'Unlimited' }}
          </h4>
          <p>Members Remaining</p>
        </div>
      </div>
  
      <!-- Box 3 (Users) -->
      <div class="col-6 col-md-3">
        <div class="box">
          <div class="number">{{ $usersCount }}</div>
          <p>Users</p>
        </div>
      </div>
  
      <!-- Box 4 (Events) -->
      <div class="col-6 col-md-3">
        <div class="box">
          <div class="number">{{ $events->count() }}</div>
          <p>Events</p>
        </div>
      </div>
    </div>
  </div>
  
</div>

<div class="container mt-5">
  <div class="row">
    <!-- Column 1 -->
    <div class="col-md-12 mb-1">
      <h4 class="text-left text-muted">Contribution</h4>
      <p class="text-left text-muted">
      All of the contriutions
      </p>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <!-- Card for Total Contribution -->
      <div class="custom-card">
        <!-- Card Header -->
        <div class="custom-card-header">
          <h2 class="">USD ${{ number_format($totalContribution, 2) }}</h2>
        </div>
        <!-- Card Body -->
        <div class="custom-card-body">
          <p class="text-muted">Total Contribution</p>
        </div>
        <!-- Card Footer -->
        <div class="custom-card-footer">
          <p>Last Month: USD ${{ number_format($lastMonthContribution, 2) }}</p>
        </div>
      </div>
    </div>
  </div>


<div class="container mt-5">
  <div class="row">
    <!-- Column 1 -->
    <div class="col-md-12 mb-1">
      <h4 class="text-left text-muted">Upcoming Events</h4>
      <p class="text-left text-muted">
      Events
      </p>
    </div>
  </div>
</div>
@endif
<div class="container">
    <div class="row justify-content-left">
       

     @foreach($events as $event)
    <div class="col-md-4">
        <div class="event-card">
            <!-- Event Header -->
            <div class="event-header d-flex justify-content-between align-items-center">
                <div class="icon">
                    <i class="far fa-calendar-check"></i>
                </div>
                <div class="icon">
                    <i class="fas fa-ellipsis-h"></i>
                </div>
            </div>

            <!-- Event Title -->
            <p class="text-muted mt-3">{{ $event->title }}</p>

            <!-- Event Body -->
            <div class="event-body">
                <p>{{ $event->description ?? 'No description available.' }}</p>
            </div>

            <!-- Event Footer -->
            <div class="event-footer d-flex justify-content-between align-items-center">
                <div class="date-time">
                    @if ($event->start_time && $event->end_time)
                        <!-- Displaying Date and Time -->
                        <span>{{ $event->start_time->format('D, d M Y') }}</span>
                        <span class="mx-4">{{ $event->start_time->format('h:i A') }} To {{ $event->end_time->format('h:i A') }}</span>
                    @else
                        <span>Time Not Available</span>
                    @endif
                </div>
            </div>

            <!-- Attendance and Check-In -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="attended">Attended: {{ $event->attendees_count ?? 0 }}</div>
                <button class="checkin-btn ">Check In</button>
            </div>
        </div>
    </div>
@endforeach







      
       
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection