@extends('dashboard.layouts.app')
@push('css')
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/owl.carousel/dist/css/owl.carousel.min.css') }}">
@endpush
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.product') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row justify-content-between mb-3">
                <div class="col-12 ">
                    <h2 class="page-heading">{{ __('site.show') }} {{ __('site.product') }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="owl-carousel offer_card_carousel" id="offer_card_carousel">
                                    @foreach ($product->images as $image)
                                        <img src="{{ asset('uploads/products') . '/' . $image }}" class="img-fluid" style="height: 450px"
                                            alt="{{ $image }}">
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h4 class="mt-3 m-b-2">{{ $product->name }}</h4>
                                        <h6 class="text-muted">{{ $product->category->name }}</h6>
                                        <div class="row">
                                            <div class="col-12 border-bottom pt-4 pb-2"><strong
                                                    class="float-left text-dark">@lang('site.name'):</strong>
                                                <span class="pull-right">{{ $product->name }}</span>
                                            </div>
                                            <div class="col-12 border-bottom pt-4 pb-2"><strong
                                                    class="float-left text-dark">@lang('site.purchase_price'):</strong>
                                                <span class="pull-right">${{ $product->purchase_price }}</span>
                                            </div>
                                            <div class="col-12 border-bottom pt-4 pb-2"><strong
                                                    class="float-left text-dark">@lang('site.sale_price'):</strong>
                                                <span class="pull-right">${{ $product->price }}</span>
                                            </div>
                                            <div class="col-12 border-bottom pt-4 pb-2"><strong
                                                    class="float-left text-dark">@lang('site.stock'):</strong>
                                                <span class="pull-right">{{ $product->stock }}</span>
                                            </div>
                                            <div class="col-12 border-bottom pt-4 pb-2"><strong
                                                    class="float-left text-dark">@lang('site.country'):</strong>
                                                <span class="pull-right">{{ $product->country }}</span>
                                            </div>
                                            <div class="col-12 border-bottom pt-4 pb-2"><strong
                                                    class="float-left text-dark">@lang('site.category'):</strong>
                                                <span class="pull-right">{{ $product->category->name }}</span>
                                            </div>
                                            <div class="col-12 border-bottom pt-4 pb-2"><strong
                                                    class="float-left text-dark">@lang('site.brand'):</strong>
                                                <span class="pull-right">{{ $product->brand->name }}</span>
                                            </div>
                                            @if ($product->car)
                                                <div class="col-12 border-bottom pt-4 pb-2"><strong
                                                        class="float-left text-dark">@lang('site.car'):</strong>
                                                    <span
                                                        class="pull-right">{{ $product->car->name . '(' . $product->start_year . '-' . $product->end_year . ')' }}</span>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4>@lang('site.description'):</h4>
                                <hr>
                                <div class="product-description">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- Owl Carousel -->
    <script src="{{ asset('dashboard/assets/plugins/owl.carousel/dist/js/owl.carousel.min.js') }}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 15,
            responsive: {
                0: {
                    items: 1
                },
            }
        })
    </script>
@endpush
