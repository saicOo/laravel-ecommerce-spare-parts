@extends('dashboard.layouts.app')
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.purchases') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row justify-content-between mb-3">
                <div class="col-12 ">
                    {{-- <h2 class="page-heading">{{ __('site.list') }} {{ __('site.purchases') }}</h2>
                    <p class="mb-0">{{ __('site.count') }} {{ __('site.purchases') }} : {{ $purchases->total() }}</p> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="p-3 bg-white rounded">
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="text-uppercase">@lang('site.invoice')</h4>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.invoice_no'):</span><span class="ml-1">#{{ $purchase->invoice_no }}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.date'):</span><span class="ml-1">{{ $purchase->updated_at->format('M d, Y') }}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.method'):</span><span class="ml-1">{{ $purchase->payment_status == 1 ? __('site.paid') : __('site.unpaid') }}</span></div>
                            </div>
                            <div class="col-md-3">
                                <h4 class="text-uppercase">@lang('site.from')</h4>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.name'):</span><span class="ml-1">{{$purchase->supplier->name}}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.phone'):</span><span class="ml-1">{{$purchase->supplier->phone}}</span></div>

                            </div>
                            <div class="col-md-3">
                                <h4 class="text-uppercase">@lang('site.to')</h4>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.name'):</span><span class="ml-1">{{$setting->name}}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.phone'):</span><span class="ml-1">{{$setting->phone}}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.address'):</span><span class="ml-1">{{$setting->address}}</span></div>
                            </div>
                            <div class="col-md-3 text-right mt-3">
                                <h4 class="text-primary mb-0">{{$setting->name}}</h4><span>sparte-parts.com</span></div>
                        </div>
                        <div class="mt-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>@lang('site.product')</th>
                                            <th>@lang('site.price')</th>
                                            <th>@lang('site.quantity')</th>
                                            <th>@lang('site.total')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchase->products as $index => $product)

                                        <tr>
                                            <td><a
                                                href="{{ route('dashboard.products.show', $product->id) }}">{{ $product->name }}</a>
                                            </td>
                                            <td>${{ number_format($product->pivot->price, 2) }}</td>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td>${{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-5">
                                    <table class="table">
                                        <tr>
                                            <th>@lang('site.total')</th>
                                            <td>${{ number_format($purchase->total_price, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-4 col-sm-5"></div>
                            </div>
                        </div>
                        <div class="text-right mb-3"><button class="btn btn-primary btn-sm mr-5" type="button">@lang('site.print')</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
