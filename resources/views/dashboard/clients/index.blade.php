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
                    <h2 class="page-heading">{{ __('site.list') }} {{ __('site.clients') }}</h2>
                    <p class="mb-0">{{ __('site.count') }} {{ __('site.clients') }} : {{ $clients->total() }}</p>
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
                                            <th scope="col">{{ __('site.first_name') }}</th>
                                            <th scope="col">{{ __('site.last_name') }}</th>
                                            <th scope="col">{{ __('site.email') }}</th>
                                            <th scope="col">{{ __('site.phone') }}</th>
                                            <th scope="col">{{ __('site.orders') }}</th>
                                            <th scope="col">{{__('site.action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $index => $client)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $client->first_name }}</td>
                                                <td>{{ $client->last_name }}</td>
                                                <td>{{ $client->email }}</td>
                                                <td>{{ $client->phone }}</td>
                                                <td>{{ $client->orders()->count() }}</td>
                                                <td>
                                                    <span>
                                                        <a href="{{ route('dashboard.clients.show', $client->id) }}"
                                                            class="mr-4" data-toggle="tooltip" data-placement="top"
                                                            title="" data-original-title="Show"><i
                                                                class="fa fa-external-link color-muted"></i> </a>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{$clients->appends(request()->query())->links("pagination::bootstrap-4")}}
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
                    <h5 class="modal-title">{{ __('site.filter') }} {{ __('site.clients') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.clients.index') }}" method="GET" id="filter-form">
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
