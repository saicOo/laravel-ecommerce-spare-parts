<header id="header" class="header-fixed">
    <div class="header d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-2 col-sm-3 col-md-4 d-flex d-lg-none mobile-icons">
                    <!--Mobile Toggle-->
                    <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                        <i class="icon cps cp-times"></i>
                        <i class="icon cps cp-bars"></i>
                    </button>
                    <!--End Mobile Toggle-->
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                    <!--Desktop Logo-->
                    <a class="logo" href="{{ url('/') }}"><img src="{{ asset('front/assets/images/logo.png') }}"
                            alt="Tacko - Auto Parts eCommerce Bootstrap5 Html Template"
                            title="Tacko - Auto Parts eCommerce Bootstrap5 Html Template" /></a>
                    <!--End Desktop Logo-->
                </div>
                <div class="col-4 col-sm-4 col-md-6 col-lg-5 col-xl-6 prs-0 d-none d-lg-block">
                    <!--Desktop Menu-->
                    <nav class="grid__item px-1 pr-0" id="AccessibleNav">
                        <ul id="siteNav" class="site-nav medium left hidearrow">
                            <li class="lvl1"><a href="{{ url('/') }}" class="active">@lang('site.home')</a></li>
                            <li class="lvl1"><a href="{{ route('products.index') }}"
                                    class="">@lang('site.products')</a></li>
                            <li class="lvl1 parent megamenu mdropdown"><a
                                    href="javascript:void(0);">@lang('site.categories')</a>
                                <div class="megamenu style1">
                                    <div class="row">
                                        @foreach ($primary_categories as $primary_category)
                                            <div class="col-md-3 col-lg-3">
                                                <h4 class="title text-uppercase">{{ $primary_category->name }}</h4>
                                                <ul class="m-items lvl-1">
                                                    @foreach ($primary_category->subCategories as $sub_category)
                                                        <li><a href="{{ route('products.index') . '?category_id=' . $sub_category->id }}"
                                                                class="site-nav">{{ $sub_category->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                        <div class="col-md-3 col-lg-3">
                                            <a href="#"><img class="blur-up lazyload"
                                                    data-src="{{ asset('front/assets/images/mm-banner1.jpg') }}"
                                                    src="{{ asset('front/assets/images/mm-banner1.jpg') }}"
                                                    alt="Engine Parts" title="Engine Parts" width="435"
                                                    height="350" /></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @guest
                            <li class="lvl1"><a href="{{ route('login') }}" class="">@lang('site.login') &
                                @lang('site.register')</a></li>
                                @endguest
                        </ul>
                    </nav>
                    <!--End Desktop Menu-->
                </div>
                <div class="col-4 col-sm-3 col-md-4 col-lg-4 col-xl-4 d-flex justify-content-end align-items-center">
                    <!--Search-->
                    <div class="serach-site px-3 d-flex d-lg-none">
                        <a href="javascript:void(0)" class="btn btn-secondary btn-lg rounded-circle search-icon"><i
                                class="cps cp-search align-middle"></i></a>
                    </div>
                    <div class="search-open d-none d-lg-flex">
                        <form action="#" method="get">
                            <div class="input-box d-flex">
                                <input type="text" name="q" value="" placeholder="Search..."
                                    class="input-text">
                                <button type="submit" title="Search" class="action search" disabled=""><i
                                        class="icon cps cp-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <!--End Search-->
                    <!--Cart Icons-->
                    <a href="{{ route('carts.index') }}"
                        class="btn btn-secondary btn-lg rounded-circle cart-icon"><i class="cp cp-shopping-cart"></i>
                        <span class="items rounded-circle">@auth{{Auth::user()->products->count()}} @endauth</span></a>
                    <!--End Cart Icons-->
                </div>
            </div>
        </div>
        <!--Search Popup-->
        <div id="search-popup" class="search-drawer">
            <div class="container">
                <span class="closeSearch cps cp-times"></span>
                <form class="form minisearch" id="header-search" action="#" method="get">
                    <label class="label"><span>Search</span></label>
                    <div class="control">
                        <div class="searchField">
                            <div class="input-box">
                                <button type="submit" title="Search" class="action search" disabled=""><i
                                        class="icon cps cp-search"></i></button>
                                <input type="text" name="q" value="" placeholder="Search by keyword or #"
                                    class="input-text">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Search Popup-->
    </div>

</header>
