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
    <script src="{{ asset('public/assets/js/modernizr.js') }}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="public/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/assets/img/favicon-32x32.png') }}" />
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/img/favicon-16x16.png') }}" />

    <link rel="manifest" href="site.webmanifest" />
  </head>

  <body id="top">
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
        <a class="site-logo" href="index.html">
          <!-- <img src="public/images/thumbs/logo.png" alt="Homepage" style="height: 100px;width: 180px;"> -->
          <h1 style="color: white; margin-top: -10px">ManjaHQ</h1>
        </a>
      </div>

      <nav class="header-nav-wrap">
        <ul class="header-nav">
        <li><a href="{{ url('/') }}" title="Home">Home</a></li>
  <li><a href="{{ url('/pricing') }}" title="Pricing">Pricing</a></li>
  <li><a href="{{ url('/login') }}" title="Services">Login</a></li>
  <li><a href="{{ url('/register') }}" title="Contact us">Signup</a></li>
        </ul>
      </nav>

      <a class="header-menu-toggle" href="#0"><span>Menu</span></a>
    </header>
    <!-- end s-header -->
  
    <!-- hero
    ================================================== -->
    <section
      class="s-hero"
      data-parallax="scroll"
      data-image-src="{{ asset('public/assets/img/hero-bg.jpg') }}"
      data-natural-width="3000"
      data-natural-height="2000"
      data-position-y="center"
    >
    
      <div class="hero-left-bar"></div>

      <div class="row hero-content">
        <div class="column large-full hero-content__text">
          <h1>
            Transform Your <br />
            Church Management<br />
            Experience
          </h1>

          <!-- <div class="hero-content__buttons">
                    <a href="events.html" class="btn btn--stroke">Upcoming Events</a>
                    <a href="about.html" class="btn btn--stroke">About Us</a>
                </div> -->
        </div>
        <!-- end hero-content__text -->
      </div>
      <!-- end hero-content -->

      <ul class="hero-social">
        <li class="hero-social__title">Follow Us</li>
        <li>
          <a href="#0" title="">Facebook</a>
        </li>
        <li>
          <a href="#0" title="">YouTube</a>
        </li>
        <li>
          <a href="#0" title="">Instagram</a>
        </li>
        <li>
          <a href="#0" title="">Twitter</a>
        </li>
      </ul>
      <!-- end hero-social -->

      <div class="hero-scroll">
        <a href="#about" class="scroll-link smoothscroll"> Scroll For More </a>
      </div>
      <!-- end hero-scroll -->
    </section>
    <!-- end s-hero -->

    <!-- about
    ================================================== -->
    <section id="about" class="s-about">
      <div class="row row-y-center about-content">
        <div class="column large-half medium-full">
          <h2 class="subhead">Welcome to ManjaHQ</h2>
          <p class="">
            Easily add new members, visitors, and volunteers to your church
            community. Keep track of their information, attendance, and
            engagement with just a few clicks.
          </p>
          <!-- <a href="about.html" class="btn btn--primary btn--about">More About Hesed</a> -->
        </div>
        <img src="{{ asset('public/assets/img/home.png') }}" alt="" style="width: 500px" />
        </div>

      <!-- end about-content -->
    </section>
    <!-- end s-about -->

    <!-- connect
    ================================================== -->
    <section class="s-connect">
      <div class="row connect-content">
        <div class="column large-half tab-full">
          <h3 class="display-1">Contributions</h3>
          <p>
            Simplify Contributions Management <br />Track donations and
            contributions effortlessly. Provide members with giving statements
            and ensure transparency and accountability in financial matters.
          </p>
          <img src="{{ asset('public/assets/img/contribution.jpg')}}" alt="" />

          <!-- <a href="volunteer.html" class="btn btn--primary h-full-width">I'm Interested</a> -->
        </div>
        <div class="column large-half tab-full">
          <h3 class="display-1">Creating Groups</h3>
          <p>
            Build and Manage Groups <br />
            Create and organize small groups, ministry teams, and committees.
            Communicate effectively and track participation and activities
            within each group.
          </p>
          <img src="{{ asset('public/assets/img/grp.jpg')}}" alt="" />

          <!-- <a href="connect-group.html" class="btn btn--primary h-full-width">Learn More</a> -->
        </div>
      </div>
      <!-- end connect-content  -->
    </section>

    <section class="s-connect">
      <div class="row connect-content">
        <div class="column large-half tab-full">
          <h3 class="display-1">Asset Tracking</h3>
          <p>
            Track and Manage Church Assets <br />
            Keep a detailed record of all church assets, from equipment to
            property. Manage maintenance schedules and ensure everything is
            accounted for and in optimal condition.
          </p>
          <img src="{{ asset('public/assets/img/contribution.jpg')}}" alt="" />

          <!-- <a href="volunteer.html" class="btn btn--primary h-full-width">I'm Interested</a> -->
        </div>
        <div class="column large-half tab-full">
          <h3 class="display-1">Adding People</h3>
          <p>
            Effortlessly Add and Manage People <br />
            Easily add new members, visitors, and volunteers to your church
            community. Keep track of their information, attendance, and
            engagement with just a few clicks."
          </p>
          <img src="{{ asset('public/assets/img/people.jpg')}}" alt="" />

          <!-- <a href="connect-group.html" class="btn btn--primary h-full-width">Learn More</a> -->
        </div>
      </div>
      <!-- end connect-content  -->
    </section>

    <section class="s-connect">
      <div class="row connect-content">
        <div class="column large-half tab-full">
          <h3 class="display-1">Reports</h3>
          <p>
            Generate Comprehensive Reports <br> Access insightful reports on
            attendance, contributions, and other key metrics. Make data-driven
            decisions to support your church's growth and operations.
          </p>
          <img src="{{ asset('public/assets/img/report.jpg')}}" alt="" />

          <!-- <a href="volunteer.html" class="btn btn--primary h-full-width">I'm Interested</a> -->
        </div>
       
      </div>
      <!-- end connect-content  -->
    </section>
    <!-- end s-connect -->

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
          <!-- <img src="{{ asset('assets/img/logo.svg') }}" alt="Homepage"> -->
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
                src="{{ asset('public/assets/img/Apple_logo_black.svg') }}"
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

  <!-- Social ================================================== -->
  <section class="s-social">
    <div class="row social-content">
      <div class="column">
        <ul class="social-list">
          <li class="social-list__item">
            <a href="#0" title="">
              <span class="social-list__icon social-list__icon--facebook"></span>
              <span class="social-list__text">Facebook</span>
            </a>
          </li>
          <li class="social-list__item">
            <a href="#0" title="">
              <span class="social-list__icon social-list__icon--twitter"></span>
              <span class="social-list__text">Twitter</span>
            </a>
          </li>
          <li class="social-list__item">
            <a href="#0" title="">
              <span class="social-list__icon social-list__icon--instagram"></span>
              <span class="social-list__text">Instagram</span>
            </a>
          </li>
          <li class="social-list__item">
            <a href="#0" title="">
              <span class="social-list__icon social-list__icon--email"></span>
              <span class="social-list__text">Youtube</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- end social-content -->
  </section>
</footer>

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

    <!-- Java Script
    ================================================== -->
    <script src="{{ asset('public/assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('public/assets/js/plugins.js') }}"></script>
<script src="{{ asset('public/assets/js/main.js') }}"></script>

  </body>
</html>
