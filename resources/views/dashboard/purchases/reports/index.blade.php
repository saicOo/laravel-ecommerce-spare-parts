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
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.purchases') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.reports') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row justify-content-between mb-3">
                <div class="col-12 ">
                    <h2 class="page-heading">{{ __('site.list') }} {{ __('site.reports') }} {{ __('site.purchases') }}</h2>
                    <p class="mb-0">{{ __('site.count') }} {{ __('site.reports') }} : {{ $reports->total() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                        data-target="#filterModal">{{ __('site.filter') }}</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table verticle-middle table-responsive-lg mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang('site.amount') @lang('site.purchases')</th>
                                            <th scope="col">@lang('site.count') @lang('site.purchases')</th>
                                            <th scope="col">{{ __('site.created_at') }}</th>
                                            <th scope="col">{{ __('site.updated_at') }}</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $index => $report)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>${{ number_format($report->purchases_amount, 2) }}</td>
                                                <td>{{ $report->purchases_count }}</td>
                                                <td>{{ $report->created_at->format('M d, Y') }}</td>
                                                <td>{{ $report->updated_at->format('M d, Y') }}</td>
                                                <td><a href="{{route('dashboard.purchases.index',['date'=> $report->created_at->format('Y-m-d')])}}">@lang('site.show')</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ $reports->appends(request()->query())->links('pagination::bootstrap-4') }}
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
                    <h5 class="modal-title">{{ __('site.filter') }} {{ __('site.reports') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.reports.index') }}" method="GET" id="filter-form">
                        <div class="form-group">
                            <label>@lang('site.date')</label>
                            <input class="form-control input-daterange-datepicker" type="text" name="daterange">
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
    <!-- Daterangepicker -->
    <!-- momment js is must -->
    <script src="{{ asset('dashboard/assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Daterangepicker -->
    <script src="{{ asset('dashboard/assets/js/plugins-init/bs-daterange-picker-init.js') }}"></script>
@endpush
