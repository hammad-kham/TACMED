<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>TACMED Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    {{-- <div class="wrapper"> --}}
    <div class="main-header">
        <div class="logo-header">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                TECMAD Dashboard
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
        </div>
        <nav class="navbar navbar-header navbar-expand-lg">
            <div class="container-fluid">

                <form class="navbar-left navbar-form nav-search mr-md-3" action="">
                    <div class="input-group">
                        <input type="text" placeholder="Search ..." class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-search search-icon"></i>
                            </span>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <li class="nav-item dropdown hidden-caret">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-envelope"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown hidden-caret">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-bell"></i>
                            <span class="notification">3</span>
                        </a>
                        <ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
                            <li>
                                <div class="dropdown-title">You have 4 new notification</div>
                            </li>
                            <li>
                                <div class="notif-center">
                                    <a href="#">
                                        <div class="notif-icon notif-primary"> <i class="la la-user-plus"></i>
                                        </div>
                                        <div class="notif-content">
                                            <span class="block">
                                                New user registered
                                            </span>
                                            <span class="time">5 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-icon notif-success"> <i class="la la-comment"></i> </div>
                                        <div class="notif-content">
                                            <span class="block">
                                                Rahmad commented on Admin
                                            </span>
                                            <span class="time">12 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-img">
                                            <img src="assets/img/profile2.jpg" alt="Img Profile">
                                        </div>
                                        <div class="notif-content">
                                            <span class="block">
                                                Reza send messages to you
                                            </span>
                                            <span class="time">12 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-icon notif-danger"> <i class="la la-heart"></i> </div>
                                        <div class="notif-content">
                                            <span class="block">
                                                Farrah liked Admin
                                            </span>
                                            <span class="time">17 minutes ago</span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="see-all" href="javascript:void(0);"> <strong>See all
                                        notifications</strong> <i class="la la-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                            aria-expanded="false"> <img src="{{ asset('backend/assets/img/profile.jpg') }}"
                                alt="user-img" width="36"
                                class="img-circle"><span>{{ Auth::guard('admin')->user()->name }}</span></span> </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <div class="user-box">
                                    <div class="u-img"><img src="{{ asset('backend/assets/img/profile.jpg') }}"
                                            alt="user"></div>
                                    <div class="u-text">
                                        <h4>{{ Auth::guard('admin')->user()->name }}</h4>
                                        <p class="text-muted">{{ Auth::guard('admin')->user()->email }}</p><a
                                            href="profile.html" class="btn btn-rounded btn-danger btn-sm">View
                                            Profile</a>
                                    </div>
                                </div>
                            </li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="ti-user"></i> My Profile</a>
                            <a class="dropdown-item" href="#"></i> My Balance</a>
                            <a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="ti-settings"></i> Account
                                Setting</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                    class="fa fa-power-off"></i> Logout</a>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    {{-- sidebar content --}}
    <div class="sidebar">
        <div class="scrollbar-inner sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> <!-- Dashboard Icon -->
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.blogs') ? 'active' : '' }}">
                    <a href="{{ route('admin.blogs') }}">
                        <i class="fas fa-newspaper"></i> <!-- Blogs Icon -->
                        <p>Blogs</p>
                        <span class="badge badge-success">{{ $count_blogs }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.category') ? 'active' : '' }}">
                    <a href="{{ route('admin.category') }}">
                        <i class="fas fa-tags"></i> <!-- Categories Icon -->
                        <p>Categories</p>
                        <span class="badge badge-danger">{{ $count_category }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.contactUs') ? 'active' : '' }}">
                    <a href="{{ route('admin.contactUs') }}">
                        <i class="fas fa-envelope"></i> <!-- Contact Us Icon -->
                        <p>Contact Us</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.privacyPolicy') ? 'active' : '' }}">
                    <a href="{{ route('admin.privacyPolicy') }}">
                        <i class="fas fa-shield-alt"></i> <!-- Privacy Policy Icon -->
                        <p>Privacy Policy</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.TermsAndCondition') ? 'active' : '' }}">
                    <a href="{{ route('admin.TermsAndCondition') }}">
                        <i class="fas fa-gavel"></i> <!-- Terms and Condition Icon -->
                        <p>Terms and Condition</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('show.users.list') ? 'active' : '' }}">
                    <a href="{{ route('show.users.list') }}">
                        <i class="fas fa-users"></i> <!-- Users Icon -->
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('stripe.checkout') ? 'active' : '' }}">
                    <a href="{{ route('stripe.checkout') }}">
                        <i class="fas fa-users"></i> <!-- Users Icon -->
                        <p>Stripe Payment</p>
                    </a>
                </li>
            </ul>



        </div>
    </div>






</body>
<script src="{{ asset('backend/assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugin/chartist/chartist.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js') }}"></script>
{{-- <script src="{{ asset('backend/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script> --}}
{{-- <script src="{{ asset('backend/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugin/jquery-mapael/jquery.mapael.min.js') }}"></script> --}}
{{-- <script src="{{ asset('backend/assets/js/plugin/jquery-mapael/maps/world_countries.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugin/chart-circle/circles.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/ready.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/demo.js') }}"></script> --}}

</html>