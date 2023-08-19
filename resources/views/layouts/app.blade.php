<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title> Dashboard - @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('/logo.jpeg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/logo.jpeg') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/vendors-rtl.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/ui/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/forms/select/select2.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/charts/apexcharts.css') }}"> --}}

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/pages/app-user.css') }}">


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <!-- END: Page CSS-->

    <!-- END: Page CSS-->
 
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style-rtl.css') }}">
    <!-- END: Custom CSS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<style>
    a,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    span {
        font-family: 'Tajawal', sans-serif
    }
</style>

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns" style="font-family: 'Tajawal', sans-serif;">

    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-left ml-auto">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link"
                                id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span
                                    class="selected-language">English</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item"
                                    href="#" data-language="en"><i class="flag-icon flag-icon-us"></i>
                                    English</a><a class="dropdown-item" href="#" data-language="fr"><i
                                        class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item"
                                    href="#" data-language="de"><i class="flag-icon flag-icon-de"></i>
                                    German</a><a class="dropdown-item" href="#" data-language="pt"><i
                                        class="flag-icon flag-icon-pt"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                                    class="ficon feather icon-maximize"></i></a></li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label"
                                href="#" data-toggle="dropdown"><i class="ficon feather icon-bell"></i><span
                                    class="badge badge-pill badge-primary badge-up">{{ $internal_notifications->where('is_read', 0)->count() }}</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header m-0 p-2">
                                        <h3 class="white">{{ $internal_notifications->count() }}
                                            New</h3><span class="grey darken-2">
                                            Notifications</span>
                                    </div>
                                </li>
                                <li class="scrollable-container media-list">
                                    @foreach ($internal_notifications as $internal_notification)
                                        <a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i
                                                        class="fa fa-info-circle font-medium-5 info"></i></div>
                                                <div class="media-body">
                                                    <h6 class="info media-heading">{{ $internal_notification->title }}
                                                    </h6><small
                                                        class="notification-text">{{ $internal_notification->details }}</small>
                                                </div><small>
                                                    <time class="media-meta"
                                                        datetime="2015-06-11T18:29:20+08:00">{{ $internal_notification->created_at->diffForHumans() }}</time></small>
                                            </div>
                                        </a>
                                    @endforeach
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center"
                                        href="/admin-panel/all_internal_notifications">Read all notifications</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a
                                class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span
                                        class="user-name text-bold-600">{{ Auth::user()->name }}</span><span
                                        class="user-status">Available</span></div><span><img class="round"
                                        src="{{ asset(Auth::user()->profile_pic ?? '/logo.jpeg') }}" alt="avatar" height="40"
                                        width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/admin-panel/edit_profile"><i class="feather icon-user"></i> تعديل البروفايل</a>
                                <a class="dropdown-item" href="/admin-panel/users/areas"><i class="feather icon-map"></i> المناطق الادارية</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i
                                        class="feather icon-power"></i> تسجيل
                                    الخروج</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="/admin-panel/dashboard">
                        <img src="{{ asset('/logo.jpeg') }}" alt="" style="width: 50px;height:50px">
                        <h2 class="brand-text mb-0">Dashboard</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                            class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                            class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary"
                            data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item  {{ request()->is('admin-panel/dashboard') ? 'active' : '' }}"><a
                        href="/admin-panel/dashboard"><i class="feather icon-home"></i><span class="menu-title"
                            data-i18n="Dashboard">Home</span></a>
                </li>
                <li class=" navigation-header"><span>Orders</span>
                </li>
                @can('manage_notification_order')
                    <li class="nav-item {{ request()->is('admin-panel/notification-orders*') ? 'active' : '' }}"><a
                            href="/admin-panel/notification-orders"><i class="fa fa-bell"></i><span class="menu-title"
                                data-i18n="Email">Notifications Orders</span></a>
                    </li>
                @endcan
                @can('manage_banner_order')
                    <li class="nav-item {{ request()->is('admin-panel/banner-orders*') ? 'active' : '' }}"><a
                            href="/admin-panel/banner-orders"><i class="fa fa-window-restore"></i><span class="menu-title"
                                data-i18n="Email">Banners Orders</span></a>
                    </li>
                @endcan
               
                <li class=" navigation-header"><span>Apps</span>
                </li>
               
                @can('manage_customer')
                    <li
                        class="nav-item {{ request()->is('admin-panel/customers*') || request()->is('admin-panel/anonymous*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-users"></i><span class="menu-title"
                                data-i18n="Starter kit">Customers</span></a>
                        <ul class="menu-content">
                            <li><a href="/admin-panel/customers"><i></i><span class="menu-item"
                                        data-i18n="2 columns">Registed Customer</span></a>
                            </li>
                            <li class=""><a href="/admin-panel/anonymous"><i></i><span class="menu-item"
                                        data-i18n="Fixed navbar">Non-Registed Customer</span></a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('manage_merchant')
                    <li class="nav-item {{ request()->is('admin-panel/merchants*') ? 'active' : '' }}"><a
                            href="/admin-panel/merchants"><i class="fa fa-vcard"></i><span class="menu-title"
                                data-i18n="Email">Merchants</span></a>
                    </li>
                @endcan
                @can('manage_store')
                    <li class="nav-item {{ request()->is('admin-panel/stores*') ? 'active' : '' }}"><a
                            href="/admin-panel/stores"><i class="fa fa-cube"></i><span class="menu-title"
                                data-i18n="Email">Stores</span></a>
                    </li>
                @endcan
                @can('manage_offer')
                    <li class="nav-item {{ request()->is('admin-panel/offers*') ? 'active' : '' }}"><a
                            href="/admin-panel/offers"><i class="fa fa-tags"></i><span class="menu-title"
                                data-i18n="Email">Offers</span></a>
                    </li>
                @endcan
                @can('send_notification')
                    {{-- <li class="nav-item {{ request()->is('admin-panel/notifications') ? 'active' : '' }}"><a
                            href="/admin-panel/notifications"><i class="fa fa-bell-o"></i><span class="menu-title"
                                data-i18n="Email">Notifications</span></a>
                    </li> --}}
                
                {{-- <li class="nav-item {{ request()->is('admin-panel/language') ? 'active' : '' }}"><a
                        href="/admin-panel/language"><i class="fa fa-cube"></i><span class="menu-title"
                            data-i18n="Email">Banners Log</span><span
                            class="badge badge badge-primary badge-pill float-right mr-2">p</span></a>
                </li> --}}
                @endcan
                @can('show_report')
                <li class=" navigation-header"><span>Reports</span>
                </li>
                    <li class="nav-item {{ request()->is('admin-panel/store-reports*') ? 'active' : '' }}"><a
                            href="/admin-panel/store-reports"><i class="fa fa-file"></i><span class="menu-title"
                                data-i18n="Email">Store Reports</span></a>
                    </li>
                @endcan
                
                <li class=" navigation-header"><span>Settings</span>
                </li>
                @can('manage_sector')
                    <li class="nav-item {{ request()->is('admin-panel/business_sectors*') ? 'active' : '' }}"><a
                            href="/admin-panel/business_sectors"><i class="fa fa-cubes"></i><span class="menu-title"
                                data-i18n="Email">Business Sectors</span></a>
                    </li>
                @endcan
                @can('manage_education_level')
                    <li class="nav-item {{ request()->is('admin-panel/education_statuses*') ? 'active' : '' }}"><a
                            href="/admin-panel/education_statuses"><i class="fa fa-leanpub"></i><span class="menu-title"
                                data-i18n="Email">Education Status</span></a>
                    </li>
                @endcan
                @can('manage_promotion')
                    <li class="nav-item {{ request()->is('admin-panel/promotions*') ? 'active' : '' }}"><a
                            href="/admin-panel/promotions"><i class="fa fa-gift"></i><span class="menu-title"
                                data-i18n="Email">Promotions</span></a>
                    </li>
                @endcan
                @can('manage_currency')
                    <li class="nav-item {{ request()->is('admin-panel/currencies*') ? 'active' : '' }}"><a
                            href="/admin-panel/currencies"><i class="fa fa-usd"></i><span class="menu-title"
                                data-i18n="Email">Currencies</span></a>
                    </li>
                @endcan
                @can('manage_state')
                    <li class="nav-item {{ request()->is('admin-panel/states*') ? 'active' : '' }}"><a
                            href="/admin-panel/states"><i class="fa fa-cube"></i><span class="menu-title"
                                data-i18n="Email">States</span></a>
                    </li>
                @endcan
                @can('manage_city')
                    <li class="nav-item {{ request()->is('admin-panel/cities*') ? 'active' : '' }}"><a
                            href="/admin-panel/cities"><i class="fa fa-building"></i><span class="menu-title"
                                data-i18n="Email">cities</span></a>
                    </li>
                @endcan
                @can('manage_user')
                    <li class="nav-item {{ request()->is('admin-panel/users*') ? 'active' : '' }}"><a
                            href="/admin-panel/users"><i class="fa fa-user-secret"></i><span class="menu-title"
                                data-i18n="Email">System Users</span></a>
                    </li>
                    {{-- <li class="nav-item {{ request()->is('admin-panel/higher_management') ? 'active' : '' }}"><a
                            href="/admin-panel/higher_management"><i class="fa fa-user-secret"></i><span class="menu-title"
                                data-i18n="Email">H.Management Users</span></a>
                    </li>
                    <li class="nav-item {{ request()->is('admin-panel/executive_management') ? 'active' : '' }}"><a
                            href="/admin-panel/executive_management"><i class="fa fa-user"></i><span
                                class="menu-title" data-i18n="Email">E.Management Users</span></a>
                    </li> --}}
                    {{-- <li class="nav-item {{ request()->is('admin-panel/user_types') ? 'active' : '' }}"><a
                            href="/admin-panel/user_types"><i class="fa fa-cube"></i><span class="menu-title"
                                data-i18n="Email">Admins Types</span></a>
                    </li> --}}
                @endcan
                @can('manage_permission')
                    <li class="nav-item {{ request()->is('admin-panel/roles*') ? 'active' : '' }}"><a
                            href="#"><i class="fa fa-lock"></i><span class="menu-title" data-i18n="Email">Roles and Permission</span></a>
                            <ul class="menu-content">
                                <li><a href="/admin-panel/roles"><i></i><span class="menu-item"
                                            data-i18n="2 columns">Roles</span></a>
                                </li>
                                <li class=""><a href="/admin-panel/roles/permissions"><i></i><span class="menu-item"
                                            data-i18n="Fixed navbar">Permissions</span></a>
                                </li>
                            </ul>
                    </li>
                @endcan
                @can('manage_country')
                <li class="nav-item {{ request()->is('admin-panel/countries*') ? 'active' : '' }}"><a
                        href="/admin-panel/countries"><i class="fa fa-building"></i><span class="menu-title"
                            data-i18n="Email">Countries</span></a>
                </li>
                {{-- <li class="nav-item {{ request()->is('admin-panel/languages') ? 'active' : '' }}"><a
                        href="/admin-panel/languages"><i class="fa fa-cube"></i><span class="menu-title"
                            data-i18n="Email">Languages</span></a>
                </li> --}}
                @endcan
                @can('manage_category')
                    <li class="nav-item {{ request()->is('admin-panel/categories*') ? 'active' : '' }}"><a
                            href="/admin-panel/categories"><i class="fa fa-sitemap"></i><span class="menu-title"
                                data-i18n="Email">categories</span></a>
                    </li>
                @endcan
                @can('manage_working_hours')
                    <li class="nav-item {{ request()->is('admin-panel/days-work*') ? 'active' : '' }}"><a
                            href="/admin-panel/days-work"><i class="fa fa-clock-o"></i><span class="menu-title"
                                data-i18n="Email">Days Work</span></a>
                    </li>
                @endcan
                @can('manage_application_setting')
                    <li class="nav-item {{ request()->is('admin-panel/app_settings*') ? 'active' : '' }}"><a
                            href="/admin-panel/app_settings"><i class="fa fa-cogs"></i><span class="menu-title"
                                data-i18n="Email">app settings</span></a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light" >
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">Copy
                {{ date('Y') }}<a class="text-bold-800 grey darken-2" href="#"
                    target="_blank">Price Crush,</a>All Rights Reserved</span><span
                class="float-md-right d-none d-md-block"> Made with<i
                    class="feather icon-heart pink"></i></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i
                    class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('/app-assets/vendors/js/ui/prism.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('/app-assets/js/scripts/pages/app-user.js') }}"></script>
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/app-assets/js/scripts/datatables/datatable.js') }}"></script>
    <script src="{{ asset('/app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
   
    
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}

    <!-- Charts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/app-assets/js/scripts/cards/card-statistics.js') }}"></script>
    <script src="{{ asset('/app-assets/js/custom.js') }}"></script>

    <!-- END: Page JS-->
    <!-- END: Theme JS-->
    @yield('scriptjs')
    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
