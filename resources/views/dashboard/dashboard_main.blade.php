
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

<div class="container my-4">
  <div class="row">
    <!-- Box 1 -->
    <div class="col-6 col-md-2">
      <div class="box">
        <div class="number">1</div>
        <p>Members</p>
      </div>
    </div>
    <!-- Box 2 -->
    <div class="col-6 col-md-2">
      <div class="box">
        <div class="number">2</div>
        <p>Families</p>
      </div>
    </div>
    <!-- Box 3 -->
    <div class="col-6 col-md-2">
      <div class="box">
        <div class="number">3</div>
        <p>Users</p>
      </div>
    </div>
    <!-- Box 4 -->
    <div class="col-6 col-md-2">
      <div class="box">
        <div class="number">4</div>
        <p>Groups</p>
      </div>
    </div>
    <!-- Box 5 -->
    <div class="col-6 col-md-2">
      <div class="box">
        <div class="number">5</div>
        <p>Events</p>
      </div>
    </div>
    <!-- Box 6 -->
    <div class="col-6 col-md-2">
      <div class="box">
        <div class="number">6</div>
        <p>Users</p>
      </div>
    </div>
    <!-- Box 7 -->
    <!-- <div class="col-6 col-md-2">
            <div class="box">
                <div class="number">7</div>
                <p>Content for Box 7</p>
            </div>
        </div> -->
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <!-- Column 1 -->
    <div class="col-md-12 mb-1">
      <h4 class="text-left text-muted">Contribution</h4>
      <p class="text-left text-muted">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur,
        quaerat
      </p>
    </div>
  </div>
</div>

<div class="container ">
  <div class="row">
    <div class="col-md-12 ">
      <!-- Card -->
      <div class="custom-card">
        <!-- Card Header -->
        <div class="custom-card-header">
          <h2 class="">USD $7299.00</h2>
        </div>
        <!-- Card Body -->
        <div class="custom-card-body">
          <p class="text-muteds">Contribution Lat Week</p>
        </div>
        <!-- Card Footer -->
        <div class="custom-card-footer">
          <p>Last Month USD $22.5k</p>
        </div>
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
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur,
        quaerat
      </p>
    </div>
  </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <!-- Event Card -->
        <div class="col-md-4">
            <div class="event-card">
                <div class="event-header">
                    <div class="icon">
                        <i class="far fa-calendar-check"></i>
                    </div>
                    
                    <div class="icon">
                        <i class="fas fa-ellipsis-h"></i>
                    </div>
                </div>
                <p class="text-muted mt-3">Leader’s Meeting</p>
                <div class="event-body">
                    <p>The hierarchy is divided in three parts: headings, bold and regular body styles. The hierarchy is divided in three parts: headings, bold and regular body styles.</p>
                </div>
                <div class="event-footer">
                    <div>
                        <div  class="date-time"><span>Tue 21 May 2024</span><span class="mx-4">8 PM To 9 PM</span></div>
                    </div>
                   
                </div>
                <div>
                    <div class="attended">Attended: 0</div>
                    <button class="checkin-btn">Check In</button>
                </div>
            </div>
        </div>

         <!-- Event Card -->
         <div class="col-md-4">
            <div class="event-card">
                <div class="event-header">
                    <div class="icon">
                        <i class="far fa-calendar-check"></i>
                    </div>
                    
                    <div class="icon">
                        <i class="fas fa-ellipsis-h"></i>
                    </div>
                </div>
                <p class="text-muted mt-3">Leader’s Meeting</p>
                <div class="event-body">
                    <p>The hierarchy is divided in three parts: headings, bold and regular body styles. The hierarchy is divided in three parts: headings, bold and regular body styles.</p>
                </div>
                <div class="event-footer">
                    <div>
                        <div  class="date-time"><span>Tue 21 May 2024</span><span class="mx-4">8 PM To 9 PM</span></div>
                    </div>
                   
                </div>
                <div>
                    <div class="attended">Attended: 0</div>
                    <button class="checkin-btn">Check In</button>
                </div>
            </div>
        </div>


         <!-- Event Card -->
         <div class="col-md-4">
            <div class="event-card">
                <div class="event-header">
                    <div class="icon">
                        <i class="far fa-calendar-check"></i>
                    </div>
                    
                    <div class="icon">
                        <i class="fas fa-ellipsis-h"></i>
                    </div>
                </div>
                <p class="text-muted mt-3">Leader’s Meeting</p>
                <div class="event-body">
                    <p>The hierarchy is divided in three parts: headings, bold and regular body styles. The hierarchy is divided in three parts: headings, bold and regular body styles.</p>
                </div>
                <div class="event-footer">
                    <div>
                        <div  class="date-time"><span>Tue 21 May 2024</span><span class="mx-4">8 PM To 9 PM</span></div>
                    </div>
                   
                </div>
                <div>
                    <div class="attended">Attended: 0</div>
                    <button class="checkin-btn">Check In</button>
                </div>
            </div>
        </div>
      
       
    </div>
</div>

