@extends('front.layouts.app')
@section('body')

    <body class="product-page">
    @endsection
    @section('content')
        <main id="page-content" class="mb-0">

            <!--Page Banner-->
            <div class="page-banner categories-page-banner text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-uppercase page-title">@lang('site.product')</h2>
                            <!--Breadcrums-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center mb-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('site.home')</a> <span><i
                                                class="cps cp-caret-right"></i></span></li>
                                    <li class="breadcrumb-item active" aria-current="page">@lang('site.product')</li>
                                </ol>
                            </nav>
                            <!--End Breadcrums-->
                        </div>
                    </div>
                </div>
            </div>
            <!--End Page Banner-->

            <!--Product Details-->
            <div class="section">
                <div class="container">
                    <div class="product-single product-single-style3">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert"><i class="cp cp-lg cp-check-circle"></i> <span
                                    class="mx-2">{{ session('success') }}</span></div>
                        @endif
                        @error('product_id')
                        <div class="alert alert-danger" role="alert"><i class="cp cp-lg cp-check-circle"></i> <span
                            class="mx-2">{{ $message }}</span></div>
                        @enderror
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-9">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="product-details-img product-horizontal-style mb-3">
                                            <div class="product-zoom">
                                                <div class="zoompro-wrap product-zoom-right pl-20">
                                                    <div class="zoompro-span">
                                                        <img id="zoompro" class="zoompro prlightbox"
                                                            src="{{ asset('uploads/products') . '/' . $product->images[0] }}"
                                                            data-zoom-image="{{ asset('uploads/products') . '/' . $product->images[0] }}"
                                                            alt="" />
                                                    </div>
                                                    <div class="product-labels"><span class="lbl new rounded">New</span>
                                                    </div>
                                                    <div class="product-buttons">
                                                        <a href="#" class="btn prlightbox rounded" title="Zoom">
                                                            <i class="cps cp-expand"></i>
                                                            <span class="tooltip-label">Zoom Image</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-thumb product-horizontal-thumb">
                                                <div id="gallery" class="product-thumb-style1">
                                                    @foreach ($product->images as $index => $image)
                                                        <a class="{{ $index == 0 ? 'active' : '' }}"
                                                            data-image="{{ asset('uploads/products') . '/' . $image }}"
                                                            data-zoom-image="{{ asset('uploads/products') . '/' . $image }}"
                                                            data-slick-index="{{ $index }}" aria-hidden="true"
                                                            tabindex="-1">
                                                            <img class="blur-up lazyload"
                                                                data-src="{{ asset('uploads/products') . '/' . $image }}"
                                                                src="{{ asset('uploads/products') . '/' . $image }}"
                                                                alt="{{ $product->name }}" />
                                                        </a>
                                                    @endforeach

                                                </div>
                                            </div>
                                            <div class="lightboximages">
                                                <a href="{{ asset('front/assets/images/products/700x700.jpg') }}"
                                                    data-size="700x700"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="product-single-detail">
                                            <h1 class="product-title text-uppercase">{{ $product->name }}</h1>
                                            <div class="d-flex justify-content-between">
                                                <div class="sku mb-1"><b>SKU:</b> #{{ $product->id }}</div>
                                            </div>
                                            <div class="stock mb-1">
                                                @if ($product->stock >= 1)
                                                    <b><span class="inStock text-uppercase"><i
                                                                class="cp cp-check-circle"></i>@lang('site.In Stock')</span></b>
                                                @else
                                                    <b><span class="text-uppercase text-danger"><i
                                                                class="cp cp-check-circle"></i>@lang('site.Out Of Stock')</span></b>
                                                @endif
                                            </div>
                                            <div class="brands mb-1"><b>@lang('site.brand'):</b> {{ $product->brand->name }}
                                            </div>
                                            <div class="cars mb-1"><b>@lang('site.car'):</b> {{ $product->car->name.' ('.$product->car->start_year.'-'.$product->car->end_year.')' }}
                                            </div>
                                            <div class="cars mb-1"><b>@lang('site.country'):</b> {{ $product->country }}
                                            </div>
                                            <div class="price-box">
                                                <span class="visually-hidden">Regular price</span>
                                                <span class="sale-price">${{ number_format($product->price, 2) }}</span>
                                            </div>

                                            <div class="sort-description">
                                                {!! $product->description !!}
                                            </div>
                                            <hr>
                                            <!-- Product Form -->
                                            <form method="post" action="{{ route('carts.store') }}" id="product_form"
                                                class="product-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <!-- Product Action -->
                                                <div class="product-action w-100 clearfix">
                                                    <div class="d-flex w-100">
                                                        <div class="product-form-quantity">
                                                            <div class="qtyField">
                                                                <a class="qtyBtn minus" href="javascript:void(0);"><i
                                                                        class="cps cp-minus"></i></a>
                                                                <input type="text" name="quantity" value="1"
                                                                    class="product-form__input qty">
                                                                <a class="qtyBtn plus" href="javascript:void(0);"><i
                                                                        class="cps cp-plus"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-form-submit">
                                                            @if ($product->stock == 0)
                                                                <button type="submit" class="btn rounded d-none"
                                                                    disabled="disabled">@lang('site.sold_out') </button>
                                                            @else
                                                                <button type="submit"
                                                                    class="btn rounded w-100 add-to-cart-btn"><i
                                                                        class="cp cp-shopping-cart"></i>
                                                                    <span>@lang('site.add_to_cart')
                                                                    </span></button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Product Action -->
                                            </form><!-- End Product Form -->

                                            <!--Social Share-->
                                            <div class="social-sharing d-flex mb-3 mt-3 clearfix">
                                                <a href="#;" target="_blank"><i class="cpb cp-facebook-f"></i></a>
                                                <a href="#;" target="_blank"><i class="cpb cp-twitter"></i></a>
                                                <a href="#;" target="_blank"><i class="cpb cp-instagram"></i></a>
                                                <a href="#;" target="_blank"><i class="cpb cp-google-plus"></i></a>
                                                <a href="#;" target="_blank"><i class="cpb cp-linkedin-in"></i></a>
                                                <a href="#;" target="_blank"><i class="cps cp-envelope"></i></a>
                                            </div>
                                            <!--End Social Share-->
                                            <!--Guranteed Checkout-->
                                            <div class="guaranteed-safe-checkout">
                                                <h4>Guaranteed Safe Checkout</h4>
                                                <img class="fade-in lazyload"
                                                    src="{{ asset('front/assets/images/garauntee-img.png') }}"
                                                    data-src="{{ asset('front/assets/images/garauntee-img.png') }}"
                                                    alt="Guaranteed Safe Checkout">
                                            </div>
                                            <!--End Guranteed Checkout-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Sidebar-->
                            <div class="col-12 col-sm-12 col-md-4 col-lg-3 sidebar">
                                <!--Store Feature-->
                                <div class="store-feature block">
                                    <div class="row">
                                        <div class="col-12 d-flex align-items-center item">
                                            <div class="icons"><i class="cp cp-truck"></i></div>
                                            <div class="detail">
                                                <b>@lang('site.home_delivery')</b>
                                                <p>@lang('site.home_delivery_p')</p>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex align-items-center item">
                                            <div class="icons"><i class="cp cp-lock"></i></div>
                                            <div class="detail">
                                                <b>@lang('site.secure_payment')</b>
                                                <p>@lang('site.secure_payment_p')</p>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex align-items-center item">
                                            <div class="icons"><i class="cp cp-hand-holding-usd"></i></div>
                                            <div class="detail">
                                                <b>@lang('site.money_back_guarantee')</b>
                                                <p>@lang('site.money_back_guarantee_p')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End Store Feature-->
                                <!--Sidebar Banner-->
                                <div class="sidebar-banner rounded-3 block border-0 p-0">
                                    <a href="#" class="d-block"><img class="blur-up lazyload rounded-3"
                                            src="{{ asset('front/assets/images/banner.jpg') }}"
                                            data-src="{{ asset('front/assets/images/banner.jpg') }}" alt=""
                                            title="" width="300" height="400" /></a>
                                </div>
                                <!--End Sidebar Banner-->
                            </div>
                            <!--End Sidebar-->
                        </div>
                    </div>
                </div>
            </div>
            <!--End Product Details-->
            <!--Related products-->
            <section class="section product-slider">
                <div class="container">
                    <div class="row">
                        <div class="section-title col-12 text-left">
                            <h2 class="title text-uppercase">@lang('site.like_this')</h2>
                        </div>
                    </div>
                    <div class="productSlider grid-products products-grid">
                        @foreach ($products_silder as $product_silder)
                            <!--Product Item-->
                            <div class="item">
                                <!--Product Image-->
                                <div class="product-image">
                                    <a href="{{ route('products.show', $product_silder->id) }}"
                                        class="rounded-3 product-thumb">
                                        <!--Image-->
                                        <img class="primary blur-up lazyload rounded-3"
                                            data-src="{{ asset('uploads/products') . '/' . $product_silder->images[0] }}"
                                            src="{{ asset('uploads/products') . '/' . $product_silder->images[0] }}"
                                            alt="{{ $product_silder->name }}" title="{{ $product_silder->name }}" />
                                        <!--End Image-->
                                        <!--Hover Image-->
                                        <img class="hover blur-up lazyload rounded-3"
                                            data-src="{{ asset('uploads/products') . '/' . $product_silder->images[0] }}"
                                            src="{{ asset('uploads/products') . '/' . $product_silder->images[0] }}"
                                            alt="{{ $product_silder->name }}" title="{{ $product_silder->name }}" />
                                        <!--End Hover Image-->
                                    </a>
                                    <!--Button Action-->
                                    <div class="button-hover">
                                        <a class="btn pro-addtocart-popup rounded btn-cart btn-primary"
                                            href="{{ route('products.show', $product_silder->id) }}"
                                            title="{{ __('site.add_to_cart') }}"><i class="cps cp-shopping-cart"></i></a>
                                    </div>
                                    <!--End Button Action-->
                                </div>
                                <!--End Product Image-->
                                <!--Product Detail-->
                                <div class="product-details d-flex">
                                    <div class="product-details-in">
                                        <div class="h3"><a
                                                href="{{ route('products.show', $product_silder->id) }}">{{ $product_silder->name }} {{ $product_silder->car->name.' ('.$product_silder->car->start_year.'-'.$product_silder->car->end_year.')' }}</a>
                                        </div>
                                        <div class="price-box"><span
                                                class="price">${{ number_format($product_silder->price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--End Product Detail-->
                            </div>
                            <!--End Product Item-->
                        @endforeach
                    </div>
                </div>
            </section>
            <!--End Related products-->

        </main>
    @endsection
