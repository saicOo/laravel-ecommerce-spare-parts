@extends('front.layouts.app')
@push('meta')
<meta name="address-governorates" content="{{ asset('assets/json/governorates.json') }}">
<meta name="address-governorate" content="{{Auth::user()->governorate}}">
<meta name="address-city" content="{{Auth::user()->city}}">
@endpush
@section('body')

    <body class="product-page">
    @endsection
    @section('content')
        <main class="checkout-page">

            <!--Page Banner-->
            <div class="page-banner cart-page-banner text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="text-uppercase">@lang('site.checkout')</h1>
                            <!--Breadcrums-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center mb-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('site.home')</a> <span><i
                                                class="cps cp-caret-right"></i></span></li>
                                    <li class="breadcrumb-item active" aria-current="page">@lang('site.checkout')</li>
                                </ol>
                            </nav>
                            <!--End Breadcrums-->
                        </div>
                    </div>
                </div>
            </div>
            <!--End Page Banner-->

            <!--Checkout Content-->
            <div class="section checkout-style1 pb-0">
                <div class="container">
                    <form action="{{ route('checkout.store') }}" method="post">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <!--Billing details-->
                            <div class="block mt-4 mb-3 billing-detail">
                                <div class="block-content">
                                    <h2 class="title text-uppercase">@lang('site.address')</h2>
                                    <div class="create-ac-content">
                                        <fieldset>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                                    <label for="address_governorate" class="form-label">@lang('site.governorate')
                                                        <span class="required">*</span></label>
                                                    <input type="hidden" name="governorate" id="inputGovernorate"
                                                        value="{{ Auth::user()->governorate }}">
                                                    <select id="address_governorate"
                                                        class="form-control @error('governorate') is-invalid @enderror">
                                                    </select>
                                                    @error('governorate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                                    <label for="address_city" class="form-label">@lang('site.city') <span
                                                            class="required">*</span></label>
                                                    <select id="address_city" name="city"
                                                        class="form-control  @error('city') is-invalid @enderror">
                                                    </select>
                                                    @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                                    <label for="input-postcode" class="form-label">@lang('site.street') <span
                                                            class="required">*</span></label>
                                                    <input name="street" value="{{ Auth::user()->street }}"
                                                        id="input-street" type="text"
                                                        class="form-control @error('street') is-invalid @enderror">
                                                    @error('street')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                                    <label for="input-postcode" class="form-label">@lang('site.building') <span
                                                            class="required">*</span></label>
                                                    <input name="building" value="{{ Auth::user()->building }}"
                                                        id="input-building" type="text"
                                                        class="form-control @error('building') is-invalid @enderror">
                                                    @error('building')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                                    <label for="input-postcode" class="form-label">@lang('site.apartment') <span
                                                            class="required">*</span></label>
                                                    <input name="apartment" value="{{ Auth::user()->apartment }}"
                                                        id="input-apartment" type="text"
                                                        class="form-control @error('apartment') is-invalid @enderror">
                                                    @error('apartment')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                                    <label for="input-postcode" class="form-label">@lang('site.floor') <span
                                                            class="required">*</span></label>
                                                    <input name="floor" value="{{ Auth::user()->floor }}"
                                                        id="input-floor" type="text"
                                                        class="form-control @error('floor') is-invalid @enderror">
                                                    @error('floor')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 mb-2">
                                                    <label for="input-postcode" class="form-label">@lang('site.phone') <span
                                                            class="required">*</span></label>
                                                    <input name="phone" value="{{ Auth::user()->phone }}"
                                                        id="input-phone" type="text"
                                                        class="form-control @error('phone') is-invalid @enderror">
                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <!--End Billing details-->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <!--Order Summary-->
                            <div class="block mb-3 order-summary">
                                <div class="block-content">
                                    <h2 class="title text-uppercase">@lang('site.order')</h2>
                                    @error('selector')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="table-responsive-sm order-table">
                                        <table class="table table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-start">@lang('site.product')</th>
                                                    <th class="text-start">@lang('site.subTotal')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td class="text-start">{{ $product->name }}</td>
                                                        <td class="text-start">
                                                            ${{ number_format($product->price * $product->pivot->quantity, 2) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-start text-uppercase"><b>@lang('site.subTotal')</b></td>
                                                    <td class="text-start">${{ number_format($sub_total, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start text-uppercase"><b>Tax</b></td>
                                                    <td class="text-start">${{ number_format($tax_amount, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start text-uppercase"><b>@lang('site.shipping')</b></td>
                                                    <td class="text-start">
                                                        {{ $setting->shipping > 0 ? '$' . $setting->shipping : __('site.free') . ' ' . __('site.shipping') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start text-uppercase"><b>@lang('site.total')</b></td>
                                                    <td class="text-start red-text">
                                                        <b>${{ number_format($total_price, 2) }}</b>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="your-payment mt-4">
                                        <h2 class="title text-uppercase">@lang('site.payment_method')</h2>
                                        <div class="payment-method">
                                                @csrf
                                                <ul class="mb-20 list-unstyled">
                                                    <li>
                                                        <input type="radio" id="option-1" name="selector" value="cash">
                                                        <label for="option-1" class="mx-2">@lang('site.cash_on_delivery') </label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="option-2" name="selector" value="online">
                                                        <label for="option-2" class="mx-2">@lang('site.online_payment')</label>
                                                    </li>
                                                </ul>
                                                <div class="order-button-payment mt-4 clearfix">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-lg rounded-pill w-100">@lang('site.place_order')</button>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Order Summary-->
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <!--End Checkout Content-->

        </main>
    @endsection
    @push('js')
        <script src="{{ asset('assets/js/address.js') }}"></script>
    @endpush
