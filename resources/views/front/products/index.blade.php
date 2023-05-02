@extends('front.layouts.app')
@section('body')

    <body class="shop-4col-page single-grid-filter">
    @endsection
    @section('content')
        <main id="page-content" class="mb-0">

            <!--Page Banner-->
            <div class="page-banner categories-page-banner text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="text-uppercase">@lang('site.products')</h1>
                            <!--Breadcrums-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center mb-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('site.home')</a> <span><i
                                                class="cps cp-caret-right"></i></span></li>
                                    <li class="breadcrumb-item active" aria-current="page">@lang('site.products')</li>
                                </ol>
                            </nav>
                            <!--End Breadcrums-->
                        </div>
                    </div>
                </div>
            </div>
            <!--End Page Banner-->

            <!--Categories Content-->
            <div class="section">
                <div class="container">
                    <div class="row">
                        <!--Sidebar-->
                        @include('front.partials.filter')
                        <!--End Sidebar-->
                        <!--YMM Dropdown-->
                        @include('front.partials._ymm')
                        <!--End YMM Dropdown-->
                        <!--Content-->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                            <!--Toolbar-->
                            <div class="toolbar py-3 pt-0">
                                <div class="filters-toolbar-wrapper">
                                    <ul class="list-unstyled d-flex align-items-center justify-content-between m-0">
                                        <li class="collection-view d-flex align-items-center">
                                            <div class="product-count d-flex align-items-center">
                                                <button type="button"
                                                    class="btn rounded btn-filter d-block me-2 me-sm-3"><span
                                                        class="hidden">Filter</span></button>
                                                <div class="filters-toolbar__item mx-2">
                                                    <span
                                                        class="filters-toolbar__product-count d-none d-sm-block">@lang('site.showing')
                                                        @lang('site.products') :
                                                        {{ $products->total() }} </span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--End Toolbar-->

                            <!--Product Grid-->
                            <div class="products-grid">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                            <!--Product Item-->
                                            <div class="item">
                                                <!--Product Image-->
                                                <div class="product-image">
                                                    <a href="{{ route('products.show', $product->id) }}"
                                                        class="rounded-3 product-thumb">
                                                        <!--Image-->
                                                        <img class="primary blur-up lazyload rounded-3"
                                                            data-src="{{ asset('uploads/products') . '/' . $product->images[0] }}"
                                                            src="{{ asset('uploads/products') . '/' . $product->images[0] }}"
                                                            alt="{{ $product->name }}" title="{{ $product->name }}" />
                                                        <!--End Image-->
                                                        <!--Hover Image-->
                                                        <img class="hover blur-up lazyload rounded-3"
                                                            data-src="{{ asset('uploads/products') . '/' . $product->images[0] }}"
                                                            src="{{ asset('uploads/products') . '/' . $product->images[0] }}"
                                                            alt="{{ $product->name }}" title="{{ $product->name }}" />
                                                        <!--End Hover Image-->
                                                    </a>
                                                    <!--Product Label-->
                                                    <div class="product-labels"><span class="lbl new rounded">New</span>
                                                    </div>
                                                    <!--End Product Label-->
                                                    <!--Button Action-->
                                                    <div class="button-hover">
                                                        <a class="btn pro-addtocart-popup rounded btn-cart btn-primary"
                                                            href="{{ route('products.show', $product->id) }}"
                                                            title="Add To Cart"><i class="cps cp-shopping-cart"></i></a>
                                                    </div>
                                                    <!--End Button Action-->
                                                </div>
                                                <!--End Product Image-->
                                                <!--Product Detail-->
                                                <div class="product-details d-flex">
                                                    <div class="product-details-in">
                                                        <div class="h3"><a
                                                                href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                                        </div>
                                                        <div class="price-box"><span
                                                                class="price">${{ number_format($product->price, 2) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--End Product Detail-->
                                            </div>
                                            <!--End Product Item-->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!--End Product Grid-->

                            <!--Pagination-->
                            <div class="row">
                                <div class="col-12">
                                    <div class="pagination">
                                        {{ $products->appends(request()->query())->links() }}
                                    </div>
                                </div>
                            </div>
                            <!--End Pagination-->
                        </div>
                        <!--End Content-->
                    </div>
                </div>
            </div>
            <!--End Categories Content-->

        </main>
    @endsection
    @push('js')
        <script src="{{ asset('front/assets/js/custom-filter.js') }}"></script>
    @endpush
