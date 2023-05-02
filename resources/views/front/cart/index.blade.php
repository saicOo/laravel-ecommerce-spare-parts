@extends('front.layouts.app')
@section('body')

    <body class="product-page">
    @endsection
    @section('content')
        <main class="cart-page1">

            <!--Page Banner-->
            <div class="page-banner cart-page-banner text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="text-uppercase">@lang('site.shopping') @lang('site.cart')</h1>
                            <!--Breadcrums-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center mb-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('site.home')</a> <span><i
                                                class="cps cp-caret-right"></i></span></li>
                                    <li class="breadcrumb-item active" aria-current="page">@lang('site.shopping')
                                        @lang('site.cart')</li>
                                </ol>
                            </nav>
                            <!--End Breadcrums-->
                        </div>
                    </div>
                </div>
            </div>
            <!--End Page Banner-->

            <!--Cart Content-->
            <div class="section pb-0 cart-style3">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                            <!-- Cart Table-->
                            <form action="{{ route('carts.update', Auth::user()->id) }}" method="post"
                                class="cart my-4 mt-0">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <table class="table cart-products mb-4">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="alt-font"></th>
                                            <th scope="col" class="alt-font"></th>
                                            <th scope="col" class="alt-font">@lang('site.product')</th>
                                            <th scope="col" class="alt-font">@lang('site.price')</th>
                                            <th scope="col" class="alt-font text-center">@lang('site.quantity')</th>
                                            <th scope="col" class="alt-font">@lang('site.total')</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($products as $index => $product)
                                            <tr>
                                                <td class="product-remove">
                                                    <a href="#" class="btn-default text-large remove"><i
                                                            class="cp cp-times"></i></a>
                                                    <input type="hidden" name="products[]" value="{{ $product->id }}">
                                                </td>
                                                <td class="product-thumbnail"><a
                                                        href="{{ route('products.show', $product->id) }}"><img
                                                            class="blur-up rounded-3 lazyloaded"
                                                            data-src="{{ asset('uploads/products') . '/' . $product->images[0] }}"
                                                            src="{{ asset('uploads/products') . '/' . $product->images[0] }}"
                                                            alt="product" title="product"></a></td>
                                                <td class="product-name">
                                                    <a
                                                        href="{{ route('products.show', $product->id) }}">{{$product->name.' '.$product->car->name.' ('.$product->car->start_year.'-'.$product->car->end_year.') '.$product->country }}</a>
                                                </td>
                                                <td class="product-price" data-title="Price">
                                                    ${{ number_format($product->price, 2) }}</td>
                                                <td class="product-quantity" data-title="Quantity">
                                                    <div class="qtyField">
                                                        <label class="screen-reader-text">@lang('site.quantity')</label>
                                                        <a class="qtyBtn minus" href="javascript:void(0);"><i
                                                                class="cps cp-minus"></i></a>
                                                        <input type="text" name="quantity[]"
                                                            value="{{ $product->pivot->quantity }}"
                                                            class="product-form__input qty">
                                                        <a class="qtyBtn plus" href="javascript:void(0);"><i
                                                                class="cps cp-plus"></i></a>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal" data-title="Total">
                                                    ${{ number_format($product->price * $product->pivot->quantity, 2) }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <th colspan="6">
                                                    <h4 class="text-center">@lang('site.no_cart_product_found')</h4>
                                                </th>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between button-set-bottom">
                                    <a href="{{ route('products.index') }}"
                                        class="btn btn-secondary rounded-3 cart-continue">@lang('site.continue')
                                        @lang('site.shopping')</a>
                                    <button type="submit" name="clear"
                                        class="btn btn-border rounded-3 small--hide mx-4">@lang('site.clear')
                                        @lang('site.shopping') @lang('site.cart')</button>
                                    <button type="submit" name="update"
                                        class="btn btn-border rounded-3 cart-continue">@lang('site.update') @lang('site.shopping')
                                        @lang('site.cart')</button>
                                </div>
                            </form>
                            <!--End Cart Table-->
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="solid-border cart-total rounded-3">
                                <h5 class="text-uppercase">@lang('site.summary')</h5>
                                <div class="row pb-2">
                                    <span class="col-6 col-sm-6 text-uppercase"><b>@lang('site.subTotal')</b></span>
                                    <span class="col-6 col-sm-6 text-end"><span
                                            class="money">${{ number_format($sub_total, 2) }}</span></span>
                                </div>
                                <div class="row pb-2 pt-2">
                                    <span class="col-6 col-sm-6 text-uppercase"><b>Tax</b></span>
                                    <span class="col-6 col-sm-6 text-end">${{ number_format($tax_amount, 2) }}</span>
                                </div>
                                <div class="row border-bottom pb-2 pt-2">
                                    <span class="col-6 col-sm-6 text-uppercase"><b>@lang('site.shipping')</b></span>
                                    <span
                                        class="col-6 col-sm-6 text-end small text-uppercase">{{ $setting->shipping > 0 ? '$' . $setting->shipping : __('site.free') . ' ' . __('site.shipping') }}</span>
                                </div>
                                <div class="row pb-2 pt-2">
                                    <span
                                        class="col-6 col-sm-6 cart__subtotal-title text-uppercase"><strong>@lang('site.total')</strong></span>
                                    <span
                                        class="col-6 col-sm-6 cart__subtotal-title cart__subtotal text-end"><b>${{ number_format($total_price, 2) }}</b></span>
                                </div>
                                <a href="{{ route('checkout.create') }}"
                                    class="btn btn-lg btn-primary rounded-pill my-4 checkout w-100">@lang('site.proceed_to_checkout')</a>
                                <p><img class="blur-up lazyloaded"
                                        src="{{ asset('front/assets/images/garauntee-img.png') }}"
                                        data-src="{{ asset('front/assets/images/garauntee-img.png') }}"
                                        alt="Guaranteed Safe Checkout"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!--You may also like products-->
            <section class="section-sm product-slider">
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
                                                class="price">${{ number_format($product_silder->price, 2) }}</span></div>
                                    </div>
                                </div>
                                <!--End Product Detail-->
                            </div>
                            <!--End Product Item-->
                        @endforeach
                    </div>
                </div>
            </section>
            <!--End You may also like products-->
            <!--End Cart Content-->

        </main>
    @endsection
    @push('js')
        <script>
            $(document).ready(function() {
                $(".remove").click(function() {
                    $(this).closest("tr").remove();
                });
            });
        </script>
    @endpush
