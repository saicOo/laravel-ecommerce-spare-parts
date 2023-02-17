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
                    <h2 class="page-heading">{{ __('site.list') }} {{ __('site.orders') }}</h2>
                    <p class="mb-0">{{ __('site.count') }} {{ __('site.orders') }} : {{ $orders->total() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header row">
                                <div class="col-md-6">
                                    <a href="{{route('dashboard.orders.create')}}" class="btn btn-primary mb-2">{{ __('site.create') }}</a>
                                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                        data-target="#filterModal">{{ __('site.filter') }}</button>
                                    <form action="{{ route('dashboard.orders.destroy', 'delete') }}" method="post"
                                        style="display: inline;">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <input type="hidden" value="" name="mass_delete" id="mass-delete">
                                        <button type="submit" id="btn-mass-delete" class="btn btn-danger mb-2"
                                            disabled>{{ __('site.mass_delete') }}</button>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table verticle-middle table-responsive-lg mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ __('site.order') }}</th>
                                            <th scope="col">{{ __('site.client') }}</th>
                                            <th scope="col">{{ __('site.date') }}</th>
                                            <th scope="col">{{ __('site.method') }}</th>
                                            <th scope="col">{{ __('site.total') }}</th>
                                            <th scope="col">{{ __('site.status') }}</th>
                                            <th scope="col">{{__('site.action')}}</th>
                                            <th scope="col"><input type="checkbox" value=""
                                                    id="check-box-delete-all"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $index => $order)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>#{{$order->id}}</td>
                                                <td>{{$order->user->first_name .' '. $order->user->last_name}}</td>
                                                <td>{{$order->updated_at->format('M d, Y')}}</td>
                                                                                               <td>{{$order->payment_method ? __('site.online') : __('site.cash')}}</td>
                                                <td>${{number_format($order->total_price,2)}}</td>
                                                @if ($order->payment_status == 1)
                                                <td><span class="rounded-pill bg-success text-white px-3 py-2">@lang('site.paid')</span></td>
                                                @elseif($order->payment_status == 2)
                                                <td><span class="rounded-pill bg-warning text-white px-3 py-2">@lang('site.waiting')</span></td>
                                                @elseif($order->payment_status == 3)
                                                <td><span class="rounded-pill bg-danger text-white px-3 py-2">@lang('site.unpaid')</span></td>
                                                @else
                                                @endif
                                                <td>
                                                    <span>
                                                        <a href="{{ route('dashboard.orders.show', $order->id) }}"
                                                            class="mr-4" data-toggle="tooltip" data-placement="top"
                                                            title="" data-original-title="Show"><i
                                                                class="fa fa-external-link color-muted"></i> </a>
                                                    </span>
                                                    <span>
                                                        <a href="{{ route('dashboard.orders.edit', $order->id) }}"
                                                            class="mr-4" data-toggle="tooltip" data-placement="top"
                                                            title="" data-original-title="Edit"><i
                                                                class="fa fa-pencil color-muted"></i> </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <input type="checkbox" value="{{ $order->id }}"
                                                            class="check-box-delete">
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{$orders->appends(request()->query())->links("pagination::bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('modal')
    <div class="modal fade" id="filterModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('site.filter') }} {{ __('site.orders') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.orders.index') }}" method="GET" id="filter-form">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('site.close') }}</button>
                    <button type="button" class="btn btn-primary"
                        onclick="event.preventDefault();
                document.getElementById('filter-form').submit();">{{ __('site.filter') }}</button>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('js')
    <script src="{{ asset('dashboard/assets/js/massDelete.js') }}"></script>
@endpush
