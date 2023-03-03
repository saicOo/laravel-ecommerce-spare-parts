@extends('dashboard.layouts.app')
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.orders') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row justify-content-between mb-3">
                <div class="col-12 ">
                  
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="p-3 bg-white rounded">
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="text-uppercase">@lang('site.invoice')</h4>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.invoice_no'):</span><span class="ml-1">#{{ $order->invoice_no }}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.date'):</span><span class="ml-1">{{ $order->updated_at->format('M d, Y') }}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.method'):</span><span class="ml-1">{{ $order->method }}</span></div>
                                @if ($order->transaction)
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.transaction_no'):</span><span class="ml-1">#{{ $order->transaction->transaction_no }}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.order_transaction_no'):</span><span class="ml-1">#{{ $order->transaction->order_transaction_no }}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.source_type'):</span><span class="ml-1">#{{ $order->transaction->source_type }}</span></div>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <h4 class="text-uppercase">@lang('site.from')</h4>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.name'):</span><span class="ml-1">{{$setting->name}}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.phone'):</span><span class="ml-1">{{$setting->phone}}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.address'):</span><span class="ml-1">{{$setting->address}}</span></div>
                            </div>
                            <div class="col-md-3">
                                <h4 class="text-uppercase">@lang('site.to')</h4>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.name'):</span><span class="ml-1">{{$order->user->first_name .' '. $order->user->last_name }}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.phone'):</span><span class="ml-1">{{$order->user->phone}}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">@lang('site.address'):</span><span class="ml-1">{{ $order->address }} | {{ __('site.building') . ': ' . $order->building . ', ' . __('site.apartment') . ': ' . $order->apartment . ', ' . __('site.floor') . ': ' . $order->floor }}</span></div>
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
                                        @foreach ($order->products as $index => $product)

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
                                            <th>@lang('site.subTotal')</th>
                                            <td>${{ number_format($order->sub_total, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tax</th>
                                            <td>${{ number_format($order->tax, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('site.shipping')</th>
                                            <td>{{ $order->shipping > 0 ? '$' . number_format($order->shipping, 2) : __('site.free') . ' ' . __('site.shipping') }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('site.total')</th>
                                            <td>${{ number_format($order->total_price, 2) }}</td>
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
