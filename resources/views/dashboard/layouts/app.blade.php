<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$setting->name}}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard/assets/images/favicon.png') }}">
    
    <link href="{{ asset('dashboard/assets/css/style.css') }}" rel="stylesheet">
    @if (app()->getLocale() == 'ar')
        <style>
            body{
                text-align: right;
            }
        </style>
    @endif
    @stack('css')
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{ url('/') }}">
                    <b class="logo-abbr">{{$setting->name[0]}}</b>
                    <span class="brand-title"><b>{{$setting->name}}</b></span>
                </a>
            </div>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        @include('dashboard.layouts.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('dashboard.layouts.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p><a href="templatespoint.net">Templates Point</a></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->


        <!--**********************************
            Right sidebar start
        ***********************************-->
        @include('dashboard.layouts.sidebar-right')
        <!--**********************************
            Right sidebar end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
    @stack('modal')
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('dashboard/assets/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/settings.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/quixnav.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/styleSwitcher.js') }}"></script>
    <!-- Bootstrap notify -->
    <script src="{{ asset('dashboard/assets/plugins/bootstrap4-notify/bootstrap-notify.min.js') }}"></script>
    @if (app()->getLocale() == 'ar')
        <script>
            (function($) {
                "use strict"

                new quixSettings({
                    direction: "rtl"
                });

            })(jQuery);
        </script>
    @endif
    @stack('js')
    @include('dashboard.partials._errors')
    @include('dashboard.partials._session')
</body>

</html>
