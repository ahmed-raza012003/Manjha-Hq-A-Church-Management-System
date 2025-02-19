<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8" />
    <title>ManjaHQ</title>
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/base.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/css/main.css') }}" />
   
    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png" />
    <link rel="manifest" href="site.webmanifest" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />

    <style>
      /* General Styles */
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        color: #333;
      }

      /* p {
          text-align: center;
          font-size: 1rem;
          margin-bottom: 10px;
        } */

      .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
      }

      /* Pricing Table Styles */
      .pricing-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      .pricing-table th,
      .pricing-table td {
        padding: 15px;
        text-align: center;
        border: 1px solid #ddd;
      }

      .pricing-table thead {
        background-color: #ffffff;
      }

      .pricing-table th {
        font-weight: bold;
      }

      .pricing-table td {
        font-size: 1.5rem;
      }

      .pricing-table .price {
        font-size: 1.8rem;
        font-weight: bold;
        color: #5541d7;
      }

      .pricing-table .btn-choose {
        display: inline-block;
        padding: 8px 15px;
        font-size: 0.9rem;
        color: #fff;
        background-color: #5541d7;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
      }

      .pricing-table .btn-choose:hover {
        background-color: #0056b3;
      }

      /* Checkmark and Cross */
      .checkmark {
        color: #5541d7;
      }

      .cross {
        color: #9e9e9e;
      }

      /* Responsive Design */
      @media screen and (max-width: 768px) {
        .pricing-table th,
        .pricing-table td {
          padding: 10px;
          font-size: 0.8rem;
        }

        .pricing-table .price {
          font-size: 1.2rem;
        }
      }

      /* Make table scrollable on small screens */
      .table-wrapper {
        overflow-x: auto; /* Enables horizontal scrolling */
        -webkit-overflow-scrolling: touch; /* Adds smooth scrolling on iOS */
        margin-bottom: 20px; /* Adds some spacing below the table */
      }

      .pricing-table {
        width: 100%; /* Ensures the table uses full width */
        min-width: 600px; /* Ensures the table doesn't shrink below a readable size */
        border-collapse: collapse; /* Proper table styling */
      }

      .selection-buttons {
        display: flex;
        border: 2px solid #ccc;
        border-radius: 25px;
        overflow: hidden;
        background-color: #fff;
        width: 200px;
      }

      .selection-option {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        outline: none;
        cursor: pointer;
        background-color: transparent;
        transition: all 0.3s ease;
        color: #666;
        text-align: center;
        flex: 1;
        user-select: none;
      }

      .selection-option.active {
        background-color: #5541d7;
        color: #fff;
        border-radius: 25px;
      }

      .selection-option:hover {
        background-color: #ddd;
        border-radius: 25px;
      }
    </style>
    <style>
      .app-buttons {
        display: flex;
        flex-direction: column;
        gap: 15px;
      }
  
      .store-button {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        width: 250px;
        border-radius: 8px;
        background-color: #000;
        color: #fff;
        text-decoration: none;
        transition: transform 0.2s ease;
      }
  
      .store-button:hover {
        transform: scale(1.05);
      }
  
      .store-button .logos {
        width: 40px;
        margin-right: 15px;
      }
  
      .store-button .text {
        display: flex;
        flex-direction: column;
      }
  
      .store-button .small-text {
        font-size: 12px;
        font-weight: normal;
        letter-spacing: 0.5px;
      }
  
      .store-button .big-text {
        font-size: 18px;
        font-weight: bold;
      }
  
      .app-store {
        background-color: #000;
      }
  
      .google-play {
        background-color: #000;
      }
      /* Make logos white */
      .white-logo {
        filter: invert(100%) brightness(200%);
      }
    </style>
  </head>

  <body id="top" style="background-color: rgb(255, 255, 255)">
<div class="table-wrapper">
    <table class="pricing-table">
      <thead>
        <tr>
          <th></th>
          @foreach($packages as $package)
              <th>
                  {{ $package->name }} <br />
                  <span class="price">${{ number_format($package->price, 2) }}</span> <br />
                  <form action="{{ route('packages.checkout', ['packageId' => $package->id]) }}" method="GET">
                    @csrf
                    <button type="submit" class="btn-choose">Choose</button>
                </form>
                
                
              </th>
          @endforeach
      </tr>
      </thead>
      <tbody>
        <tr>
          <td>Add People</td>
          @foreach($packages as $package)
              <td class="cross">
                  {{ $package->max_members ?? 'Unlimited' }}
              </td>
          @endforeach
      </tr>
        <tr>
          <td>Store and Filter</td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
        </tr>
        <tr>
          <td>Email and Text</td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
        </tr>
        <tr>
          <td>Create and Share</td>
          <td><i class="fas fa-times cross"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
        </tr>
        <tr>
          <td>Quick Access</td>
          <td><i class="fas fa-times cross"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
        </tr>
        <tr>
          <td>Member Management</td>
          @foreach($packages as $package)
              <td>
                  @if($package->can_manage_members)
                      <i class="fas fa-check checkmark"></i>
                  @else
                      <i class="fas fa-times cross"></i>
                  @endif
              </td>
          @endforeach
      </tr>
      <tr>
        <td>Max Groups</td>
        @foreach($packages as $package)
            <td class="cross">
                {{ $package->max_groups ?? 'Unlimited' }}
            </td>
        @endforeach
    </tr>
        <tr>
          <td>Advanced Reports</td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
        </tr>
        <tr>
          <td>Elections</td>
          <td><i class="fas fa-times cross"></i></td>
          <td><i class="fas fa-times cross"></i></td>
          <td><i class="fas fa-times cross"></i></td>
          <td><i class="fas fa-times cross"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
        </tr>
        <tr>
          <td>Priority Support</td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
          <td><i class="fas fa-check checkmark"></i></td>
        </tr>
      </tbody>
    </table>
  </div>
  
    <script>
        const options = document.querySelectorAll(".selection-option");
  
        options.forEach((option) => {
          option.addEventListener("click", () => {
            options.forEach((opt) => opt.classList.remove("active"));
            option.classList.add("active");
          });
        });
      </script>
  
      <!-- Java Script
      ================================================== -->
      <script src="{{ asset('public/js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('public/js/plugins.js') }}"></script>
  <script src="{{ asset('public/js/main.js') }}"></script>
  
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
    </body>
  </html>
  