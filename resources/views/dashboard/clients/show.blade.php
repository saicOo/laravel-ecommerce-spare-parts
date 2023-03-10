@extends('dashboard.layouts.app')
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.clients') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row justify-content-between mb-3">
                <div class="col-12 ">
                    <h2 class="page-heading">{{ __('site.show') }} {{ __('site.client') }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="media align-items-center mb-4">
                                    <img class="mr-3 circle-rounded"
                                        src="{{ asset('dashboard/assets/images/users/5.jpg') }}" width="80"
                                        height="80" alt="">
                                    <div class="media-body">
                                        <h5 class="mb-0">{{ $client->first_name }}</h5>
                                        <p class="text-muted mb-0">{{ $client->last_name }}</p>
                                    </div>
                                </div>

                                <h4>@lang('site.address')</h4>
                                <p class="text-muted">{{ $client->governorate . ', ' . $client->city . ', ' . $client->street }} |
                                    {{ __('site.building') . ': ' . $client->building . ', ' . __('site.apartment') . ': ' . $client->apartment . ', ' . __('site.floor') . ': ' . $client->floor }}
                                </p>
                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">@lang('site.phone')</strong>
                                        <span>{{ $client->phone }}</span></li>
                                    <li><strong class="text-dark mr-4">@lang('site.email')</strong>
                                        <span>{{ $client->email }}</span></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <div id="accordion-faq" class="accordion">
                                    @foreach ($client->orders as $order)
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0 collapsed c-pointer" data-toggle="collapse"  style='text-decoration: {{$order->payment_status == 1 && $order->tracking == 5 ? "line-through;" : ""}}'
                                                    data-target="#collapseOne{{ $order->id }}" aria-expanded="false"
                                                    aria-controls="collapseOne{{ $order->id }}"><i class="fa"
                                                        aria-hidden="true"></i>{{ $order->created_at->format('M d, Y') . ' ' . __('order') . ': #' . $order->id }}
                                                </h5>
                                            </div>
                                            <div id="collapseOne{{ $order->id }}" class="collapse"
                                                data-parent="#accordion-faq">
                                                <div class="card-body">
                                                    <table class="table">
                                                        <tr>
                                                            <th>@lang('site.count') @lang('site.products')</th>
                                                            <td>{{ $order->products->count() }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>@lang('site.method')</th>
                                                            <td>{{ $order->payment_method ? __('site.online') : __('site.cash') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>@lang('site.status')</th>
                                                            @if ($order->payment_status == 1)
                                                                <td class="text-success">@lang('site.paid')</td>
                                                            @elseif($order->payment_status == 2)
                                                                <td class="text-warning">@lang('site.pending')</td>
                                                            @elseif($order->payment_status == 3)
                                                                <td class="text-danger">@lang('site.unpaid')</td>
                                                            @else
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th>@lang('site.total')</th>
                                                            <td>${{ number_format($order->total_price, 2) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center" colspan="2"><a
                                                                    href="{{ route('dashboard.orders.show', $order->id) }}">@lang('site.show')</a>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
