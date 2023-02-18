@extends('front.layouts.app')
@section('body')

    <body class="home demo1">
    @endsection
    @section('content')
        <main id="page-content">
            <!--Homepage Slideshow-->
            <div class="slideshow home-slideshow p-0">
                <div class="slide">
                    <div class="blur-up lazyload">
                        <img class="blur-up lazyload desktop-hide"
                            data-src="{{ asset('front/assets/images/slideshow/slide1.jpg') }}"
                            src="{{ asset('front/assets/images/slideshow/slide1.jpg') }}"
                            alt="Easy way to find the right car parts &amp; service"
                            title="Easy way to find the right car parts &amp; service" width="1920" height="620" />
                        <img class="blur-up lazyload mobile-hide"
                            data-src="{{ asset('front/assets/images/slideshow/slide1-mobile.jpg') }}"
                            src="{{ asset('front/assets/images/slideshow/slide1-mobile.jpg') }}"
                            alt="Easy way to find the right car parts &amp; service"
                            title="Easy way to find the right car parts &amp; service" width="1181" height="620">
                        <div class="container position-relative">
                            <div class="slideshow-overlay btmleft text-left">
                                <div class="slideshow-content">
                                    <div class="wrap-caption animation style1">
                                        <h2 class="mega-title white-text text-uppercase">Easy way to find the right<br>
                                            car Parts &amp; Service</h2>
                                        <a href="{{ route('products.index') }}" class="btn rounded-pill">@lang('site.shop_now')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="blur-up lazyload">
                        <img class="blur-up lazyload desktop-hide"
                            data-src="{{ asset('front/assets/images/slideshow/slide1.jpg') }}"
                            src="{{ asset('front/assets/images/slideshow/slide1.jpg') }}"
                            alt="Customize, Modify, Upgrade, Repair, Replace"
                            title="Customize, Modify, Upgrade, Repair, Replace" width="1920" height="620" />
                        <img class="blur-up lazyload mobile-hide"
                            data-src="{{ asset('front/assets/images/slideshow/slide1-mobile.jpg') }}"
                            src="{{ asset('front/assets/images/slideshow/slide1-mobile.jpg') }}"
                            alt="Customize, Modify, Upgrade, Repair &amp; Replace All any parts"
                            title="Customize, Modify, Upgrade, Repair &amp; Replace All any parts<" width="1181"
                            height="620">
                        <div class="container position-relative">
                            <div class="slideshow-overlay btmright text-right">
                                <div class="slideshow-content">
                                    <div class="wrap-caption animation style1">
                                        <h2 class="mega-title white-text text-uppercase">Customize, Modify,
                                            Upgrade,<br>Repair &amp; Replace any parts.</h2>
                                        <a href="{{ route('products.index') }}" class="btn rounded-pill">@lang('site.shop_now')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Homepage Slideshow-->

            <!--Small Banner-->
            <div class="section small-banners pt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="small-banner-item rounded-3">
                                <img class="blur-up lazyload rounded-3 w-100"
                                    data-src="{{ asset('front/assets/images/small-banner1-630-320.jpg') }}"
                                    src="{{ asset('front/assets/images/small-banner1-630-320.jpg') }}" alt="Spyder"
                                    title="Spyder" width="630" height="320">
                                <div class="detail">
                                    <h3 class="title text-uppercase mb-0">Spyder</h3>
                                    <h4 class="text-uppercase">Headlights &amp; Tail Lights</h4>
                                    <p>Conquer the night with Spyder lighting products. The illumination you demand. The
                                        look you aspire.</p>
                                    <a href="#" class="btn btn-primary btn--small">Explore Now!</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="small-banner-item rounded-3">
                                <img class="blur-up lazyload rounded-3 w-100"
                                    data-src="{{ asset('front/assets/images/small-banner2-630-320.jpg') }}"
                                    src="{{ asset('front/assets/images/small-banner2-630-320.jpg') }}" alt="Vossen"
                                    title="Vossen" width="630" height="320">
                                <div class="detail">
                                    <h3 class="title text-uppercase mb-0">Vossen</h3>
                                    <h4 class="text-uppercase">Wheels &amp; Rims</h4>
                                    <p>Mastering the art of innovation to create wheels that blend the ultimate in
                                        performance and style.</p>
                                    <a href="#" class="btn btn-primary btn--small">Buy Now!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Small Banner-->

            <!--Category Tabs-->
            <div class="section category-tab-section pt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="category-tabs">
                                <ul
                                    class="category-tab-items list-unstyled d-flex-wrap m-0 d-none d-lg-flex justify-content-center">
                                    @foreach ($categories as $index => $category)
                                        <li rel="{{ 'tab-category-' . $category->id }}"
                                            class="{{ $index == 0 ? 'active' : '' }}"><a
                                                class="tablink">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                                <!--Category Tabs Content-->
                                <div class="c-tab-container mt-5">
                                    @foreach ($categories as $index => $category)
                                        <h3 class="c-tabs-ac-style c-acor-ttl d-lg-none {{ $index == 0 ? 'active' : '' }}"
                                            rel="{{ 'tab-category-' . $category->id }}">{{ $category->name }}</h3>
                                        <div id="{{ 'tab-category-' . $category->id }}" class="c-tab-content">
                                            <div class="row">
                                                @foreach ($category->products as $i => $product)
                                                    <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                                                        <div class="category-box">
                                                            <a href="{{ route('products.show', $product->id) }}">
                                                                <img class="blur-up lazyload rounded-3 w-100"
                                                                    data-src="{{ asset('uploads/products') . '/' . $product->images[0] }}"
                                                                    src="{{ asset('uploads/products') . '/' . $product->images[0] }}"
                                                                    alt="{{ $product->name }}"
                                                                    title="{{ $product->name }}" width="188"
                                                                    height="188">
                                                                <span
                                                                    class="title text-center">{{ $product->name }}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @if ($i == 5)
                                                    @break
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!--End Category Tabs Content-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Category Tabs-->
        <!--Activity-->
        <div class="section journey-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2 class="title mb-1 text-uppercase">@lang('site.activity')</h2>
                            <h1 class="text-uppercase yellow-title">@lang('site.our_Journey').</h1>
                        </div>
                    </div>
                </div>
                <!--Number Counter-->
                <div class="row counter-section">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="counter-item d-flex align-items-center">
                            <div class="icon"><i class="cp cp-user-tie"></i></div>
                            <div class="counter">
                                <span class="counter-store counter-number">733</span> <span class="plus-sign">+</span>
                                <p>Active Clients</p>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="counter-item d-flex align-items-center">
                            <div class="icon"><i class="cp cp-coffee"></i></div>
                            <div class="counter">
                                <span class="counter-number">33K</span> <span class="plus-sign">+</span>
                                <p>Cup of Coffee</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="counter-item d-flex align-items-center">
                            <div class="icon"><i class="cp cp-star"></i></div>
                            <div class="counter">
                                <span class="counter-rewards counter-number">100</span> <span
                                    class="plus-sign">+</span>
                                <p>Get Rewards</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="counter-item d-flex align-items-center">
                            <div class="icon"><i class="cp cp-globe"></i></div>
                            <div class="counter">
                                <span class="counter-country counter-number">25</span> <span
                                    class="plus-sign">+</span>
                                <p>Country Cover</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Number Counter-->
            </div>
        </div>
        <!--End Activity-->

        <!--Small Banner-->
        <div class="section small-banners-style2">
            <div class="container">
                <div class="row">
                    <!--Column 1-->
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 mb-4">
                                <div class="small-banner-item rounded-3">
                                    <img class="blur-up lazyload rounded-3 w-100"
                                        data-src="{{ asset('front/assets/images/small-banner2-1-300x300.jpg') }}"
                                        src="{{ asset('front/assets/images/small-banner2-1-300x300.jpg') }}"
                                        alt="How to Choose the Best Car Cover?"
                                        title="How to Choose the Best Car Cover?" width="300" height="300">
                                    <div class="detail leftCenter">
                                        <h4 class="text-uppercase">How to Choose the Best Car Cover?</h4>
                                        <a href="https://www.youtube.com/watch?v=ScMzIvxBSi4?autoplay=1&rel=0"
                                            class="btn btn-primary rounded-pill mfpbox mfp-with-anim popup-video"><i
                                                class="cp cp-lg align-middle cp-play-circle"></i> Play Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                <div class="small-banner-item rounded-3">
                                    <img class="blur-up lazyload rounded-3 w-100"
                                        data-src="{{ asset('front/assets/images/small-banner2-1-300x300.jpg') }}"
                                        src="{{ asset('front/assets/images/small-banner2-1-300x300.jpg') }}"
                                        alt="Custom Interior" title="Custom Interior" width="300" height="300">
                                    <div class="detail leftCenter">
                                        <h4 class="text-uppercase mb-0">Custom</h4>
                                        <h3 class="title text-uppercase mb-1">Interior</h3>
                                        <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill">@lang('site.shop_now')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Column 1-->
                    <!--Column 2-->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="small-banner-item rounded-3">
                                    <img class="blur-up lazyload rounded-3 w-100"
                                        data-src="{{ asset('front/assets/images/small-banner2-3-632x632.jpg') }}"
                                        src="{{ asset('front/assets/images/small-banner2-3-632x632.jpg') }}"
                                        alt="Custom Wheels" title="Custom Wheels" width="632" height="632">
                                    <div class="detail leftCenter">
                                        <h4 class="text-uppercase mb-0">Custom</h4>
                                        <h3 class="title text-uppercase mb-1">Wheels</h3>
                                        <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill">@lang('site.shop_now')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Column 2-->
                    <!--Column 3-->
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 mb-4">
                                <div class="small-banner-item rounded-3">
                                    <img class="blur-up lazyload rounded-3 w-100"
                                        data-src="{{ asset('front/assets/images/small-banner2-1-300x300.jpg') }}"
                                        src="{{ asset('front/assets/images/small-banner2-1-300x300.jpg') }}"
                                        alt="Custom Paint" title="Custom Paint" width="300" height="300">
                                    <div class="detail leftCenter">
                                        <h4 class="text-uppercase mb-0">Custom</h4>
                                        <h3 class="title text-uppercase mb-1">Paint</h3>
                                        <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill">@lang('site.shop_now')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                <div class="small-banner-item rounded-3">
                                    <img class="blur-up lazyload rounded-3 w-100"
                                        data-src="{{ asset('front/assets/images/small-banner2-1-300x300.jpg') }}"
                                        src="{{ asset('front/assets/images/small-banner2-1-300x300.jpg') }}"
                                        alt="Custom Tail Lights" title="Custom Tail Lights" width="300"
                                        height="300">
                                    <div class="detail leftCenter">
                                        <h4 class="text-uppercase mb-0">Custom</h4>
                                        <h3 class="title text-uppercase mb-1">Tail Lights</h3>
                                        <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill">@lang('site.shop_now')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Column 3-->
                </div>
            </div>
        </div>
        <!--End Small Banner-->

    </main>
@endsection
