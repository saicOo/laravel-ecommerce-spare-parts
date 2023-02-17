@extends('front.layouts.app')
@push('css')
    <!-- font-awesome 4.7.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Main Progressbar CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/progressbar.css') }}">
@endpush
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
                            <h1 class="text-uppercase">@lang('site.order')</h1>
                            <!--Breadcrums-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center mb-0">
                                    <li class="breadcrumb-item"><a href="index.html">@lang('site.home')</a> <span><i
                                                class="cps cp-caret-right"></i></span></li>
                                    <li class="breadcrumb-item active" aria-current="page">@lang('site.order')</li>
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
                        <div class="col-12">
                            {{-- start tracking --}}
                            <!-- Add class 'active' to progress -->
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <ul id="progressbar" class="text-center">
                                        <li class="step0 {{ $order->tracking >= 1 ? 'active' : '' }}"></li>
                                        <li class="step0 {{ $order->tracking >= 2 ? 'active' : '' }}"></li>
                                        <li class="step0 {{ $order->tracking >= 3 ? 'active' : '' }}"></li>
                                        <li class="step0 {{ $order->tracking == 4 ? 'active' : '' }}"></li>
                                    </ul>
                                </div>
                            </div>
                            {{-- end tracking --}}
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                            <!-- Cart Table-->
                            <table class="table cart-products mb-4">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th scope="col" class="alt-font">@lang('site.product')</th>
                                        <th scope="col" class="alt-font">@lang('site.price')</th>
                                        <th scope="col" class="alt-font text-center">@lang('site.quantity')</th>
                                        <th scope="col" class="alt-font">@lang('site.total')</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($order->products as $index => $product)
                                        <tr>
                                            <td class="product-thumbnail"><a
                                                    href="{{ route('products.show', $product->id) }}"><img
                                                        class="blur-up rounded-3 lazyloaded"
                                                        data-src="{{ asset('uploads/products') . '/' . $product->images[0] }}"
                                                        src="{{ asset('uploads/products') . '/' . $product->images[0] }}"
                                                        alt="product" title="product"></a></td>
                                            <td class="product-name">
                                                <a
                                                    href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                ${{ number_format($product->price, 2) }}</td>
                                            <td class="product-quantity" data-title="Quantity">
                                                {{ $product->pivot->quantity }}
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
                            <!--End Cart Table-->
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="solid-border cart-total rounded-3">
                                <h5 class="text-uppercase">@lang('site.summary') @lang('site.invoice')</h5>
                                <div class="row pb-2">
                                    <span class="col-6 col-sm-6 text-uppercase"><b>@lang('site.order')</b></span>
                                    <span class="col-6 col-sm-6 text-end"><span
                                            class="money">#{{ $order->id }}</span></span>
                                </div>
                                <div class="row pb-2">
                                    <span class="col-6 col-sm-6 text-uppercase"><b>@lang('site.date')</b></span>
                                    <span class="col-6 col-sm-6 text-end"><span
                                            class="money">{{ $order->updated_at->format('M d, Y') }}</span></span>
                                </div>
                                <div class="row pb-2">
                                    <span class="col-6 col-sm-6 text-uppercase"><b>@lang('site.address')</b></span>
                                    <span class="col-6 col-sm-6 text-end"><span class="money">{{ $order->address }} |
                                            {{ __('site.building') . ': ' . $order->building . ', ' . __('site.apartment') . ': ' . $order->apartment . ', ' . __('site.floor') . ': ' . $order->floor }}</span></span>
                                </div>
                                <div class="row pb-2">
                                    <span class="col-6 col-sm-6 text-uppercase"><b>@lang('site.method')</b></span>
                                    <span class="col-6 col-sm-6 text-end"><span
                                            class="money">{{ $order->payment_method ? __('site.online') : __('site.cash') }}</span></span>
                                </div>
                                @if ($order->transaction)
                                    <div class="row pb-2">
                                        <span class="col-6 col-sm-6 text-uppercase"><b>@lang('site.transaction_id')</b></span>
                                        <span class="col-6 col-sm-6 text-end"><span
                                                class="money">#{{ $order->transaction->transaction_id }}</span></span>
                                    </div>
                                    <div class="row pb-2">
                                        <span class="col-6 col-sm-6 text-uppercase"><b>@lang('site.order_transaction_id')</b></span>
                                        <span class="col-6 col-sm-6 text-end"><span
                                                class="money">#{{ $order->transaction->order_transaction_id }}</span></span>
                                    </div>
                                    <div class="row pb-2">
                                        <span class="col-6 col-sm-6 text-uppercase"><b>@lang('site.source_type')</b></span>
                                        <span class="col-6 col-sm-6 text-end"><span
                                                class="money">{{ $order->transaction->source_type }}</span></span>
                                    </div>
                                @endif
                                <div class="row pb-2">
                                    <span class="col-6 col-sm-6 text-uppercase"><b>@lang('site.status')</b></span>
                                    <span class="col-6 col-sm-6 text-end">
                                        @if ($order->payment_status == 1)
                                            <span class="money text-success">@lang('site.paid')</span>
                                        @elseif($order->payment_status == 2)
                                            <span class="money text-warning">@lang('site.waiting')</span>
                                        @elseif($order->payment_status == 3)
                                            <span class="money text-danger">@lang('site.unpaid')</span>
                                        @else
                                        @endif
                                    </span>
                                </div>

                                <div class="row pb-2">
                                    <span class="col-6 col-sm-6 text-uppercase"><b>@lang('site.subTotal')</b></span>
                                    <span class="col-6 col-sm-6 text-end"><span
                                            class="money">${{ number_format($order->sub_total, 2) }}</span></span>
                                </div>
                                <div class="row pb-2">
                                    <span class="col-6 col-sm-6 text-uppercase"><b>Tax</b></span>
                                    <span class="col-6 col-sm-6 text-end"><span
                                            class="money">${{ number_format($order->tax, 2) }}</span></span>
                                </div>
                                <div class="row border-bottom pb-2 pt-2">
                                    <span class="col-6 col-sm-6 text-uppercase"><b>@lang('site.shipping')</b></span>
                                    <span
                                        class="col-6 col-sm-6 text-end small text-uppercase">{{ $order->shipping > 0 ? '$' . number_format($order->shipping, 2) : __('site.free') . ' ' . __('site.shipping') }}</span>
                                </div>
                                <div class="row pb-2 pt-2">
                                    <span
                                        class="col-6 col-sm-6 cart__subtotal-title text-uppercase"><strong>@lang('site.total')</strong></span>
                                    <span
                                        class="col-6 col-sm-6 cart__subtotal-title cart__subtotal text-end"><b>${{ number_format($order->total_price, 2) }}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <!--End Cart Content-->

        </main>
    @endsection
