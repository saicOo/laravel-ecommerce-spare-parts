@extends('front.layouts.app')
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
                            <h1 class="text-uppercase">Checkout Style1</h1>
                            <!--Breadcrums-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center mb-0">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a> <span><i
                                                class="cps cp-caret-right"></i></span></li>
                                    <li class="breadcrumb-item active" aria-current="page">Checkout Style1</li>
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                            <!--Order Summary-->
                            <div class="block mb-3 order-summary">
                                <div class="block-content">
                                    <h2 class="title text-uppercase">Your order</h2>
                                    <div class="table-responsive-sm order-table">
                                        <table class="table table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-start">Product</th>
                                                    <th class="text-start">Subtotal</th>
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
                                                    <td class="text-start text-uppercase"><b>Subtotal</b></td>
                                                    <td class="text-start">${{ number_format($total_price, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start text-uppercase"><b>Shipping</b></td>
                                                    <td class="text-start">Flat rate: $10.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start text-uppercase"><b>Total</b></td>
                                                    <td class="text-start red-text">
                                                        <b>${{ number_format($total_price, 2) }}</b>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="your-payment mt-4">
                                        <h2 class="title text-uppercase">payment method</h2>
                                        <div class="payment-method">
                                            <form action="{{ route('checkout.store') }}" method="post">
                                                @csrf
                                                <ul class="mb-20 list-unstyled">
                                                    <li>
                                                        <input type="radio" id="option-1" name="selector" value="cash"
                                                            checked>
                                                        <label for="option-1" class="mx-2">@lang('site.cash_on_delivery') </label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="input-payment" name="selector" value="online">
                                                        <label for="input-payment" class="mx-2">@lang('site.online_payment')</label>
                                                    </li>
                                                </ul>
                                                <div class="order-button-payment mt-4 clearfix">
                                                    <button type="submit" id="btn-checkout"
                                                        class="btn btn-primary btn-lg rounded-pill w-100">Place
                                                        order</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Order Summary-->
                        </div>
                    </div>
                </div>
            </div>
            <!--End Checkout Content-->

        </main>
    @endsection
    @push('js')
        <script src="{{ asset('front/assets/js/paymob.js') }}"></script>
        <script>
            $(document).ready(function() {



                //delete
                $('#btn-checkout').click(function(e) {

                    e.preventDefault();

                    if ($('#input-payment').prop("checked")) {
                        firstStep();
                    } else {
                        $(this).closest('form').submit();
                    }

                }); //end of delete
            }); //end of ready
        </script>
    @endpush
