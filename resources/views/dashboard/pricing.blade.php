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
    <link rel="stylesheet" href="{{ asset('assets/css/base.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
   
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
  </head>

  <body id="top" style="background-color: rgb(255, 255, 255)">
    <!-- preloader
    ================================================== -->
    <div id="preloader">
      <div id="loader" class="dots-jump">
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>

    <!-- header
    ================================================== -->
    <header class="s-header">
  <div class="header-logo">
    <a class="site-logo" href="{{ url('/') }}">
      <h1 style="color: white; margin-top: -10px">ManjaHQ</h1>
    </a>
  </div>

  <nav class="header-nav-wrap">
    <ul class="header-nav">
      <li><a href="{{ url('/') }}" title="Home">Home</a></li>
      <li><a href="{{ url('/pricing') }}" title="Pricing">Pricing</a></li>
      <li><a href="{{ url('/login') }}" title="Login">Login</a></li>
      <li><a href="{{ url('/signup') }}" title="Signup">Signup</a></li>
    </ul>
  </nav>

  <a class="header-menu-toggle" href="#0"><span>Menu</span></a>
</header>

    <!-- end s-header -->

    <!-- page header
    ================================================== -->
    <section class="page-header page-header--about">
      <div class="gradient-overlay"></div>
      <div class="row page-header__content">
        <div class="column">
          <h1>ManjaHQ Pricing</h1>
        </div>
      </div>
    </section>
    <!-- end page-header -->

    <div class="container" style="margin-top: 50px">
      <!-- Header -->
      <center>
        <p>Whatever your church size, manage it with affordable pricing</p>
        <p style="color: #259c41; font-weight: 200">
          Pay for 10 months instead of 12 when paying annually!
        </p>

        <div class="selection-buttons">
          <div id="monthly" class="selection-option active">Monthly</div>
          <div id="annually" class="selection-option">Annually</div>
        </div>
      </center>

      <!-- Pricing Table -->

      <div class="table-wrapper">
        <table class="pricing-table">
          <thead>
            <tr>
              <th></th>
              <th>
                V. Small <br />
                <span class="price">$12</span> <br />
                <a href="#" class="btn-choose">Choose</a>
              </th>
              <th>
                Small <br />
                <span class="price">$25</span> <br />
                <a href="#" class="btn-choose">Choose</a>
              </th>
              <th>
                Medium <br />
                <span class="price">$40</span> <br />
                <a href="#" class="btn-choose">Choose</a>
              </th>
              <th>
                Large <br />
                <span class="price">$50</span> <br />
                <a href="#" class="btn-choose">Choose</a>
              </th>
              <th>
                Unlimited <br />
                <span class="price">$60</span> <br />
                <a href="#" class="btn-choose">Choose</a>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Add People</td>
              <td class="cross">100</td>
              <td class="cross">250</td>
              <td class="cross">500</td>
              <td class="cross">1000</td>
              <td class="cross">Unlimited</td>
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
              <td><i class="fas fa-times cross"></i></td>
              <td><i class="fas fa-check checkmark"></i></td>
              <td><i class="fas fa-check checkmark"></i></td>
              <td><i class="fas fa-check checkmark"></i></td>
              <td><i class="fas fa-check checkmark"></i></td>
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
    </div>




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

    <!-- footer
    ================================================== -->
    <footer class="s-footer">
      <div class="row footer-top">
        <div class="column large-4 medium-5 tab-full">
          <div class="footer-logo">
            <a class="site-footer-logo" href="">
              <!-- <img src="images/logo.svg" alt="Homepage"> -->
              <h1 style="color: white; margin-top: -10px">ManjaHQ</h1>
            </a>
          </div>
          <!-- footer-logo -->
          <p>
            Laborum ad explicabo. Molestiae voluptates est. Quisquam labore
            tenetur et assumenda voluptatibus a beatae. Rerum odio ducimus
            reprehenderit sit animi laborum nostrum dolorum animi voluptates est
            voluptatibus a beatae.
          </p>
        </div>
        <div class="column large-half tab-full">
          <div class="row">
            <div class="column large-5 medium-full">
              <h4 class="h6">Quick Links</h4>
              <ul class="footer-list">
                <li><a href="">Home</a></li>
                <li><a href="">Pricing</a></li>
                <li><a href="">LogIn</a></li>
                <li><a href="">SignUp</a></li>
              </ul>
            </div>
            <div class="app-buttons">
                <a href="">
                  <div class="store-button app-store">
                    <img
                      src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg"
                      alt=""
                      class="logos white-logo"
                    />
                    <div class="text">
                      <span class="small-text">Download on the</span>
                      <span class="big-text">App Store</span>
                    </div>
                  </div>
                </a>
  
                <a href="#">
                  <div class="store-button google-play">
                    <div class="logos">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"
                        width="40"
                        fill="white"
                      >
                        <path
                          d="M325.3 234.3L104.6 25.4 103.6 25c-7.5-4.5-17-5.3-25.2-.8-8.2 4.4-13.3 12.7-13.3 22v439.6c0 9.3 5 17.5 13.2 21.9s17.6 3.7 25.2-.7l1.1-.7 220.7-209.2c6.2-5.7 9.7-13.8 9.7-22.4s-3.5-16.6-9.7-22.3zm39.7 18.4c0 3.7 0 7.3-.2 11 0 4.3.2 8.5.8 12.7 2.7 17.6 10.8 32.9 22.9 44.8l84.5 82.5c6.1 5.8 9.6 13.9 9.6 22.3s-3.5 16.5-9.6 22.3L365.7 487.5c-14.3 11.3-34 11.3-48.2 0-48.2-32.7-126.7-85.3-173.3-116.7l-27.2-18.2 92.3-87.4L365.7 487.5c-13.5-11.3-32.8-11.3-47.2 0l.5-.3zm91.3-73c6.2 5.7 9.7 13.8 9.7 22.3 0 8.5-3.5 16.5-9.7 22.3L366 300.8l-91.8-86.9 148.2-148 84.6 82.5c12.1 11.9 20.2 27.3 22.9 44.9 0 3.3.2 6.5.2 9.7z"
                        />
                      </svg>
                    </div>
                    <div class="text">
                      <span class="small-text">ANDROID APP ON</span>
                      <span class="big-text">Google Play</span>
                    </div>
                  </div>
                </a>
              </div>
          </div>
        </div>
      </div>
      <!-- end footer-top -->

      <!-- Social
    ================================================== -->
      <section class="s-social">
        <div class="row social-content">
          <div class="column">
            <ul class="social-list">
              <li class="social-list__item">
                <a href="#0" title="">
                  <span
                    class="social-list__icon social-list__icon--facebook"
                  ></span>
                  <span class="social-list__text">Facebook</span>
                </a>
              </li>
              <li class="social-list__item">
                <a href="#0" title="">
                  <span
                    class="social-list__icon social-list__icon--twitter"
                  ></span>
                  <span class="social-list__text">Twitter</span>
                </a>
              </li>
              <li class="social-list__item">
                <a href="#0" title="">
                  <span
                    class="social-list__icon social-list__icon--instagram"
                  ></span>
                  <span class="social-list__text">Instagram</span>
                </a>
              </li>
              <li class="social-list__item">
                <a href="#0" title="">
                  <span
                    class="social-list__icon social-list__icon--email"
                  ></span>
                  <span class="social-list__text">Youtube</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- end social-content -->
      </section>
      <!-- end s-social -->

      <div class="row footer-bottom">
        <div class="column ss-copyright">
          <span>© Copyright ManjaHQ</span>
        </div>
      </div>
      <!-- footer-bottom -->

      <div class="ss-go-top">
        <a class="smoothscroll" title="Back to Top" href="#top">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
          >
            <path d="M12 0l8 9h-6v15h-4v-15h-6z" />
          </svg>
        </a>
      </div>
      <!-- ss-go-top -->
    </footer>
    <!-- end s-footer -->

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
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/plugins.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
  </body>
</html>
