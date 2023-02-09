@extends('dashboard.layouts.app')
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.cars') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row justify-content-between mb-3">
                <div class="col-12 ">
                    <h2 class="page-heading">{{ __('site.list') }} {{ __('site.cars') }}</h2>
                    <p class="mb-0">{{ __('site.count') }} {{ __('site.cars') }} : {{ $cars->total() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header row">
                                <div class="col-md-6">
                                    <a href="{{route('dashboard.cars.create')}}" class="btn btn-primary mb-2">{{ __('site.create') }}</a>
                                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                        data-target="#filterModal">{{ __('site.filter') }}</button>
                                    <form action="{{ route('dashboard.cars.destroy', 'delete') }}" method="post"
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
                                            <th scope="col">{{ __('site.name') }}</th>
                                            <th scope="col">{{ __('site.factory') }}</th>
                                            <th scope="col">{{ __('site.start_year') }}</th>
                                            <th scope="col">{{ __('site.end_year') }}</th>
                                            <th scope="col">{{__('site.action')}}</th>
                                            <th scope="col"><input type="checkbox" value=""
                                                    id="check-box-delete-all"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cars as $index => $car)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $car->name }}</td>
                                                <td>{{ $car->factoryCar->name }}</td>
                                                <td>{{ $car->start_year }}</td>
                                                <td>{{ $car->end_year }}</td>
                                                <td>
                                                    <span>
                                                        <a href="{{ route('dashboard.cars.edit', $car->id) }}"
                                                            class="mr-4" data-toggle="tooltip" data-placement="top"
                                                            title="" data-original-title="Edit"><i
                                                                class="fa fa-pencil color-muted"></i> </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <input type="checkbox" value="{{ $car->id }}"
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
                            <nav>
                                <ul class="pagination pagination-sm pagination-style-2">
                                    @php
                                        $append_url = '';
                                        if (isset(request()->query()['search'])) {
                                            $append_url = '&factoryCar_id=' . request()->query()['factoryCar_id'] . '&search=' . request()->query()['search'];
                                        }
                                    @endphp
                                    <li class="page-item page-indicator {{ $cars->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $cars->previousPageUrl() . $append_url }}">
                                            <i class="icon-arrow-left"></i></a>
                                    </li>
                                    @foreach ($cars->getUrlRange(1, $cars->lastPage()) as $num_page => $url_page)
                                        <li class="page-item {{ $num_page === $cars->currentPage() ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ $url_page . $append_url }}">{{ $num_page }}</a>
                                        </li>
                                    @endforeach
                                    <li class="page-item page-indicator {{ $cars->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link " href="{{ $cars->nextPageUrl() . $append_url }}">
                                            <i class="icon-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
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
                    <h5 class="modal-title">{{ __('site.filter') }} {{ __('site.cars') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.cars.index') }}" method="GET" id="filter-form">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div>
                        <div class="form-group">
                            <select name="factory_car_id" class="form-control">
                                <option value="" selected>@lang('site.factories') @lang('site.cars')</option>
                                @foreach ($factoryCars as $factoryCar)
                                    <option value="{{ $factoryCar->id }}"
                                        {{ request()->factory_car_id == $factoryCar->id ? 'selected' : '' }}>
                                        {{ $factoryCar->name }}</option>
                                @endforeach
                            </select>
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
@endpush
