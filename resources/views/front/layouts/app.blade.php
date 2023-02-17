<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="description">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$setting->name}}</title>
    <!--Favicon Icon-->
    <link rel="shortcut icon" href="{{ asset('front/assets/images/favicon.png') }}" />
    <!--Google Fonts-->
    <link href="//fonts.googleapis.com/css2?family=Mukta:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins.css') }}">
    @if (app()->getLocale() == 'ar')
        <!-- Main RTL Style CSS -->
        <link rel="stylesheet" href="{{ asset('front/assets/css/rtl-style.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/rtl-responsive.css') }}">
    @else
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/responsive.css') }}">
    @endif
    @stack('css')
</head>


    @yield('body')
    <!--Preloader-->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!--End Preloader-->
    <div class="page-wrapper">
        <!--TopBar-->
        @include('front.layouts.top-bar')
        <!--End TopBar-->
        <!--Header-->
        @include('front.layouts.header')
        <!--Header-->

        <!--Mobile Drawer Menu-->
        @include('front.layouts.mob-nav')
        <!--End Mobile Drawer Menu-->

        <!--Page Content-->
        @yield('content')
        <!--End Page Content-->

        <!--Footer-->
        @include('front.layouts.footer')
        <!--End Footer-->

        <!--Scoll Top-->
        <span id="site-scroll"><i class="cps cp-arrow-up"></i></span>
        <!--End Scoll Top-->

        <!--MiniCart Drawer-->
        {{-- @include('front.layouts.mini-cart') --}}
        <!--End MiniCart Drawer-->

        <!--Newsletter Popup-->
        {{-- <div id="newsletter-modal" class="style1 mfp-with-anim mfp-hide rounded-3">
            <div class="newsletter-popup d-flex flex-column">
                <div class="newsltr-text text-start">
                    <div class="wraptext">
                        <h3 class="mb-0 text-uppercase">GET UP TO 25% OFF</h3>
                        <h2 class="text-uppercase">Sign up to Tacko</h2>
                        <p class="sub-text">Subscribe to the Tacko Autoparts newsletter to receive updates on special
                            offers.</p>
                        <form action="#" class="mcNewsletter" method="post">
                            <div class="input-group rounded-3 d-flex">
                                <input type="email" class="newsletter__input border-0" name="EMAIL"
                                    value="" placeholder="Your Email address" required>
                                <button type="submit" class="btn btn-primary rounded"
                                    name="commit"><span>Subscribe</span></button>
                            </div>
                        </form>
                        <p class="checkboxlink mt-4 text-uppercase">
                            <input type="checkbox" id="dontshow" class="form-check-input m-0">
                            <label for="dontshow" class="mx-2 align-middle">Don't show this popup again</label>
                        </p>
                    </div>
                </div>
            </div>
            <button title="Close (Esc)" type="button" class="mfp-close"></button>
        </div> --}}
        <!--End Newsletter Popup-->

        <div class="modalOverly"></div>

        <!-- Including Jquery -->
        <script src="{{ asset('front/assets/js/vendor/jquery-min.js') }}"></script>
        <script src="{{ asset('front/assets/js/vendor/js.cookie.js') }}"></script>
        <!--Including Javascript-->
        <script src="{{ asset('front/assets/js/plugins.js') }}"></script>

        @if (app()->getLocale() == 'ar')
            <script src="{{ asset('front/assets/js/rtl-main.js') }}"></script>
        @else
            <script src="{{ asset('front/assets/js/main.js') }}"></script>
        @endif
        @stack('js')
        <!--Newsletter Popup Cookies-->
        {{-- <script>
            function newsletter_popup() {
                var cookieSignup = "cookieSignup",
                    date = new Date();
                if ($.cookie(cookieSignup) != 'true' && window.location.href.indexOf("challenge#newsletter-modal") <= -1) {
                    setTimeout(function() {
                        $.magnificPopup.open({
                            items: {
                                src: '#newsletter-modal'
                            },
                            type: 'inline',
                            removalDelay: 300,
                            mainClass: 'mfp-zoom-in'
                        });
                    }, 5000);
                }
                $.magnificPopup.instance.close = function() {
                    if ($("#dontshow").prop("checked") == true) {
                        $.cookie(cookieSignup, 'true', {
                            expires: 1,
                            path: '/'
                        });
                    }
                    $.magnificPopup.proto.close.call(this);
                }
            }
            newsletter_popup();
        </script> --}}
        <!--End Newsletter Popup Cookies-->

    </div>
    <!--page-wrapper-->
</body>

</html>
