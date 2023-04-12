@extends('dashboard.layouts.app')
@push('css')
    <!-- Daterange picker -->
    <link href="{{ asset('dashboard/assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endpush
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
                    <h2 class="page-heading">{{ __('site.list') }} {{ __('site.purchases') }}</h2>
                    <p class="mb-0">{{ __('site.count') }} {{ __('site.purchases') }} : {{ $purchases->total() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header row">
                                <div class="col-md-6">
                                    <a href="{{ route('dashboard.purchases.create') }}"
                                        class="btn btn-primary mb-2">{{ __('site.create') }}</a>
                                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                        data-target="#filterModal">{{ __('site.filter') }}</button>
                                    <a class="btn btn-primary mb-2" href="{{ route('dashboard.export-purchases') }}">
                                        @lang('site.export')
                                    </a>
                                    <form action="{{ route('dashboard.purchases.destroy', 'delete') }}" method="post"
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
                                            <th scope="col">{{ __('site.invoice_no') }}</th>
                                            <th scope="col">{{ __('site.client') }}</th>
                                            <th scope="col">{{ __('site.total') }}</th>
                                            <th scope="col">{{ __('site.status') }}</th>
                                            <th scope="col">{{ __('site.type') }}</th>
                                            <th scope="col">{{ __('site.date') }}</th>
                                            <th scope="col">{{ __('site.action') }}</th>
                                            <th scope="col"><input type="checkbox" value=""
                                                    id="check-box-delete-all"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchases as $index => $purchase)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>#{{ $purchase->invoice_no }}</td>
                                                <td>{{ $purchase->supplier->name }}</td>
                                                <td>${{ number_format($purchase->total_price, 2) }}</td>
                                                <td>
                                                    <span
                                                        class="rounded-pill {{$purchase->payment_status == 1 ? 'bg-success' : 'bg-warning'}} text-white px-3 py-2">{{$purchase->status}}</span>
                                                </td>
                                                <td>
                                                    {{$purchase->type}}
                                                </td>
                                                <td>{{ $purchase->updated_at->format('M d, Y') }}</td>
                                                <td>
                                                    <span>
                                                        <a href="{{ route('dashboard.purchases.show', $purchase->id) }}"
                                                            class="mr-4" data-toggle="tooltip" data-placement="top"
                                                            title="" data-original-title="{{__('site.show')}}"><i
                                                                class="fa fa-external-link color-muted"></i> </a>
                                                    </span>
                                                    @if ($purchase->active == 0)
                                                    <span>
                                                        <a href="{{ route('dashboard.purchases.edit', $purchase->id) }}"
                                                            class="mr-4" data-toggle="tooltip" data-placement="top"
                                                            title="" data-original-title="{{__('site.approval')}}"><i
                                                                class="fa fa-chevron-circle-down color-muted"></i> {{__('site.approval')}}</a>
                                                    </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span>
                                                        <input type="checkbox" value="{{ $purchase->id }}"
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
                            {{ $purchases->appends(request()->query())->links('pagination::bootstrap-4') }}
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
                    <h5 class="modal-title">{{ __('site.filter') }} {{ __('site.purchases') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.purchases.index') }}" method="GET" id="filter-form">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div>
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option disabled selected>@lang('site.select') @lang('site.status')</option>
                                <option value="1" {{ request()->status == 1 ? 'selected' : '' }}>@lang('site.paid')
                                </option>
                                <option value="2" {{ request()->status == 2 ? 'selected' : '' }}>@lang('site.pending')
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="payment_type" class="form-control">
                                <option disabled selected>@lang('site.select') @lang('site.type')</option>
                                <option value="1" {{ request()->payment_type == 1 ? 'selected' : '' }}>@lang('site.new')
                                </option>
                                <option value="2" {{ request()->payment_type == 2 ? 'selected' : '' }}>@lang('site.return')
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('site.date')</label>
                            <input class="form-control input-daterange-datepicker" type="text" name="daterange">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('site.close') }}</button>
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
    <!-- Daterangepicker -->
    <!-- momment js is must -->
    <script src="{{ asset('dashboard/assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Daterangepicker -->
    <script src="{{ asset('dashboard/assets/js/plugins-init/bs-daterange-picker-init.js') }}"></script>
@endpush
