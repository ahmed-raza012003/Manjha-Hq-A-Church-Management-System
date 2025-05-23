<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>
  
    </title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="public/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

 
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('public/assets/css/plugins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('public/assets/css/kaiadmin.min.css') }}" />
<link rel="stylesheet" href="{{ asset('public/assets/css/demo.css') }}" />

  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="white">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="white">
            <a href="{{ url('/dashboard') }}" class="logo"><img src="{{ asset('public/assets/img/logo.png') }}" alt="navbar brand" class="navbar-brand" height="40" /></a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
              <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
            </div>
            <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
              <ul class="nav nav-secondary">
                  
                  <!-- Dashboard (Visible to All) -->
                  <li class="nav-item">
                      <a href="{{ route('dashboard') }}">
                          <i class="fas fa-th-large"></i>
                          <p>Dashboard</p>
                      </a>
                    </li>
                    @role('super admin')
                  <li class="nav-item">
                    <a href="{{ route('users.index') }}">
                        <i class="fas fa-user"></i>
                        <p>Users</p>
                    </a>
                </li>
                @endrole
                  <!-- Members (Only for 'super admin' and 'church administrator') -->
                  @role('super admin|church administrator')
                  <li class="nav-item">
                      <a href="{{ route('members.index') }}">
                          <i class="fas fa-user-friends"></i>
                          <p>Members</p>
                      </a>
                  </li>
                  @endrole
      
                  <!-- Groups (Only for 'super admin' and 'volunteer coordinator') -->
                  @role('super admin|volunteer coordinator')
                  <li class="nav-item">
                      <a href="{{ route('groups.index') }}">
                          <i class="fa fa-users"></i>
                          <p>Groups</p>
                      </a>
                  </li>
                  @endrole
      
                  <!-- Asset Tracking (Only for 'super admin' and 'church administrator') -->
                  @role('super admin|church administrator')
                  <li class="nav-item">
                      <a href="{{ route('assets.index') }}">
                          <i class="fas fa-wallet"></i>
                          <p>Asset Tracking</p>
                      </a>
                  </li>
                  @endrole
      
                  <!-- Events (Only for 'super admin' and 'event manager') -->
                  @role('super admin|event manager')
                  <li class="nav-item">
                      <a href="{{ route('events.index') }}">
                          <i class="fas fa-calendar-alt"></i>
                          <p>Events</p>
                      </a>
                  </li>
                  @endrole
      
                  <!-- Reports (Only for 'super admin' and 'financial officer') -->
                  @role('super admin|financial officer')
                  <li class="nav-item">
                      <a href="{{ route('reports.index') }}">
                          <i class="fas fa-chart-bar"></i>
                          <p>Reports</p>
                      </a>
                  </li>
                  @endrole
      
                  <!-- Contributions Dropdown (Only for 'super admin' and 'financial officer') -->
                  @role('super admin|financial officer')
                  <li class="nav-item">
                      <a data-bs-toggle="collapse" href="#contributionSubmenu">
                          <i class="fas fa-chart-line"></i>
                          <p>Contribution</p>
                          <span class="caret"></span>
                      </a>
                      <div class="collapse" id="contributionSubmenu">
                          <ul class="nav nav-collapse">
                              <li>
                                  <a href="{{ route('contributions.create') }}">
                                      <i class="fa fa-plus-circle"></i> New Contribution
                                  </a>
                              </li>
                              <li>
                                  <a href="{{ route('contributions.index') }}">
                                      <i class="fas fa-chart-line"></i> All Contributions
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>
                  @endrole
      
                  <!-- Settings (Only for 'super admin') -->
                  @role('super admin')
                  <li class="nav-item">
                      <a data-bs-toggle="collapse" href="#settingsSubmenu">
                          <i class="fas fa-cog"></i>
                          <p>Settings</p>
                          <span class="caret"></span>
                      </a>
                      <div class="collapse" id="settingsSubmenu">
                          <ul class="nav nav-collapse">
                              <li>
                                  <a href="{{ route('integrations.index') }}">
                                      <i class="fas fa-puzzle-piece"></i> Integrations
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>
                  @endrole
      
                  <!-- Logout (Visible to All) -->
                  <li class="nav-item">
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="fa fa-sign-out-alt"></i>
                          <p>Logout</p>
                      </a>
                  </li>
      
                  <!-- Hidden Form for Logout -->
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
      
              </ul>
          </div>
      </div>
      
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="white">
              <a href="index.html" class="logo"><img src="{{ asset('public/assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20" /></a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
              </div>
              <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
              <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1"><i class="fa fa-search search-icon"></i></button>
                  </div>
                  <input type="text" placeholder="Search ..." class="form-control" />
                </div>
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true"><i class="fa fa-search"></i></a>
                  <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                      <div class="input-group">
                        <input type="text" placeholder="Search ..." class="form-control" />
                      </div>
                    </form>
                  </ul>
                </li>

                <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <span class="notification">4</span>
                  </a>
                  <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                    <li>
                      <div class="dropdown-title">You have 4 new notification</div>
                    </li>
                    <li>
                      <div class="notif-scroll scrollbar-outer">
                        <div class="notif-center">
                          <a href="#">
                            <div class="notif-icon notif-primary">
                              <i class="fa fa-user-plus"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block">New user registered</span>
                              <span class="time">5 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-icon notif-success">
                              <i class="fa fa-comment"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block">Rahmad commented on Admin</span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img src="assets/img/profile2.jpg" alt="Img Profile" />
                            </div>
                            <div class="notif-content">
                              <span class="block">Reza send messages to you</span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-icon notif-danger">
                              <i class="fa fa-heart"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block">Farrah liked Admin</span>
                              <span class="time">17 minutes ago</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i></a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                    <img src="{{ asset('public/assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle" />
                    </div>
                    <span class="profile-username">
                      <span class="fw-bold">Hizrian</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="u-text">
                            <h4>Hizrian</h4>
                            <p class="text-muted">hello@example.com</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" hrefhref="{{ route('logout') }}" >Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
          @yield('content')
          </div>
        </div>
      </div>

      <!-- End Custom template -->
    </div>

    <script src="{{ asset('public/assets/js/plugin/webfont/webfont.min.js') }}"></script>
<!-- Core JS Files -->
<script src="{{ asset('public/assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('public/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('public/assets/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->

<!-- jQuery Sparkline -->
<script src="{{ asset('public/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('public/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('public/assets/js/plugin/jsvectormap/world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('public/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Kaiadmin JS -->
<script src="{{ asset('public/assets/js/kaiadmin.min.js') }}"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ asset('public/assets/js/setting-demo.js') }}"></script>
<script src="{{ asset('public/assets/js/demo.js') }}"></script>

   
  </body>
</html>
