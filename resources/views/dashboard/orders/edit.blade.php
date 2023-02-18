@extends('dashboard.layouts.app')
@push('css')
<!-- Switchery -->
<link href="{{ asset('dashboard/assets/plugins/innoto-switchery/dist/switchery.min.css') }}" rel="stylesheet"/>
@endpush
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{__('site.orders')}}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">@lang('site.edit') @lang('site.order')</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.orders.update',$order->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('site.status')</label>
                                            <select class="form-control" name="payment_status">
                                                <option value="1" {{ $order->payment_status == 1 ? 'selected' : '' }}>@lang('site.paid')</option>
                                                <option value="2" {{ $order->payment_status == 2 ? 'selected' : '' }}>@lang('site.waiting')</option>
                                                <option value="3" {{ $order->payment_status == 3 ? 'selected' : '' }}>@lang('site.unpaid')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('site.order_tracking')</label>
                                            <select class="form-control" name="tracking">
                                                <option value="1" {{ $order->tracking == 1 ? 'selected' : '' }}>@lang('site.ordered')</option>
                                                <option value="2" {{ $order->tracking == 2 ? 'selected' : '' }}>@lang('site.accept_order')</option>
                                                <option value="3" {{ $order->tracking == 3 ? 'selected' : '' }}>@lang('site.shipped_order')</option>
                                                <option value="4" {{ $order->tracking == 4 ? 'selected' : '' }}>@lang('site.delivery_order')</option>
                                                <option value="5" {{ $order->tracking == 5 ? 'selected' : '' }}>@lang('site.received_order')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>@lang('site.address')</label>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $order->address }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('site.building')</label>
                                            <input type="text" class="form-control @error('building') is-invalid @enderror" name="building" value="{{ $order->building }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('site.apartment')</label>
                                            <input type="text" class="form-control @error('apartment') is-invalid @enderror" name="apartment" value="{{ $order->apartment }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('site.floor')</label>
                                            <input type="text" class="form-control @error('floor') is-invalid @enderror" name="floor" value="{{ $order->floor }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table verticle-middle table-responsive-lg mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">{{ __('site.product') }}</th>
                                                        <th scope="col">{{ __('site.price') }}</th>
                                                        <th scope="col">{{ __('site.quantity') }}</th>
                                                        <th scope="col">{{ __('site.total') }}</th>
                                                        <th scope="col">{{ __('site.status') }}</th>
                                                        <th scope="col">{{__('site.return')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->products as $index => $product)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{$product->name}}</td>
                                                            <td>${{number_format($product->pivot->price,2)}}</td>
                                                            <td>{{$product->pivot->quantity}}</td>
                                                            <td>${{number_format($order->total_price,2)}}</td>
                                                            <td class="{{$product->pivot->return_status == true ? 'text-danger' : ''}}">{{$product->pivot->return_status == true ? __('site.return') : '-'}}</td>
                                                            <td>
                                                                @if ($product->pivot->return_status)
                                                                <input disabled="disabled" id="chk_3" type="checkbox" class="js-switch js-switch-1 js-switch-sm return-broduct" data-size="small" />
                                                                @else
                                                                <input onchange="this.checked == true ? alert('{{ $product->name . __('site.deleted_product') }}') : ''" name="products[]" value="{{$product->id}}" id="chk_3" type="checkbox" class="js-switch js-switch-1 js-switch-sm return-broduct" data-size="small" />
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-rounded btn-primary">@lang('site.update')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<!-- Switchery -->
<script src="{{ asset('dashboard/assets/plugins/innoto-switchery/dist/switchery.min.js') }}"></script>
<!-- Switchery init -->
<script src="{{ asset('dashboard/assets/js/plugins-init/switchery-init.js') }}"></script>
@endpush
