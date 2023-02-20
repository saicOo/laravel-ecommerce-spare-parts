@extends('dashboard.layouts.app')
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{__('site.factories')}} {{__('site.cars')}}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row justify-content-between mb-3">
                <div class="col-12 ">
                    <h2 class="page-heading">{{ __('site.list') }} {{__('site.factories')}} {{__('site.cars')}}</h2>
                    <p class="mb-0">{{ __('site.count') }} {{__('site.factories')}} {{__('site.cars')}} : {{ $factory_cars->total() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header row">
                                <div class="col-md-6">
                                    <a href="{{ route('dashboard.factory-cars.create') }}"
                                        class="btn btn-primary mb-2">{{ __('site.create') }}</a>
                                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                        data-target="#filterModal">{{ __('site.filter') }}</button>
                                        {{-- btn-excel --}}
                                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                    data-target="#excelModal">Excel</button>
                                    {{-- btn-mass-delete --}}
                                    <form action="{{ route('dashboard.factory-cars.destroy', 'delete') }}" method="post"
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
                                            <th scope="col">{{ __('site.action') }}</th>
                                            <th scope="col"><input type="checkbox" value=""
                                                    id="check-box-delete-all"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($factory_cars as $index => $factory_car)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $factory_car->name }}</td>
                                                <td>
                                                    <span>
                                                        <a href="{{ route('dashboard.factory-cars.edit', $factory_car->id) }}"
                                                            class="mr-4" data-toggle="tooltip" data-placement="top"
                                                            title="" data-original-title="Edit"><i
                                                                class="fa fa-pencil color-muted"></i> </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <input type="checkbox" value="{{ $factory_car->id }}"
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
                            {{$factory_cars->appends(request()->query())->links("pagination::bootstrap-4")}}
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
                    <h5 class="modal-title">{{ __('site.filter') }} {{__('site.factories')}} {{__('site.cars')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.factory-cars.index') }}" method="GET" id="filter-form">
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
    <!-- start excel modal -->
    <div class="modal fade" id="excelModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excel</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.import-factoryCars') }}" method="POST" enctype="multipart/form-data" id="excel-form">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="file" class="form-control mb-2 @error('file') is-invalid @enderror">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('site.close') }}</button>
                    <button type="button" class="btn btn-primary"
                        onclick="event.preventDefault();
                document.getElementById('excel-form').submit();">@lang('site.import')</button>
                <a class="btn btn-warning" href="{{ route('dashboard.export-factoryCars') }}">
                    @lang('site.export')
                </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end excel modal -->
@endpush
@push('js')
    <script src="{{ asset('dashboard/assets/js/massDelete.js') }}"></script>
@endpush

