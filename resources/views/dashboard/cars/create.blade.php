@extends('dashboard.layouts.app')
@push('css')
        <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/select2/css/select2.min.css') }}">
@endpush
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.cars') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.create') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">@lang('site.create') @lang('site.car')</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.cars.store') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.ar.name')</label>
                                            <input type="text"
                                                class="form-control @error('name_ar') is-invalid @enderror" name="name_ar"
                                                value="{{ old('name_ar') }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.en.name')</label>
                                            <input type="text"
                                                class="form-control @error('name_en') is-invalid @enderror" name="name_en"
                                                value="{{ old('name_en') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.start_year')</label>
                                            <select
                                                class="single-select @error('start_year') is-invalid @enderror"
                                                name="start_year">
                                                <option value="" disabled selected>@lang('site.choose') @lang('site.year')...
                                                </option>
                                                @for ($i = date("Y"); $i > 1900; $i--)
                                                <option value="{{$i}}" {{ $i == old('start_year') ? 'selected': ''}}>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.end_year')</label>
                                            <select
                                                class="single-select @error('end_year') is-invalid @enderror"
                                                name="end_year">
                                                <option value="" disabled selected>@lang('site.choose') @lang('site.year')...
                                                </option>
                                                @for ($i = date("Y"); $i > 1900; $i--)
                                                <option value="{{$i}}" {{ $i == old('end_year') ? 'selected': ''}} >{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>@lang('site.factory') @lang('site.car')</label>
                                            <select name="factory_car_id" class="single-select"  >
                                                <option value="" disabled selected>@lang('site.choose') @lang('site.factory') @lang('site.car')...
                                                </option>
                                                @foreach ($factory_cars as $factory_car)
                                                    <option value="{{$factory_car->id}}" {{ $factory_car->id == old('factory_car_id') ? 'selected': ''}}>{{ $factory_car->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-12 pt-3">
                                        <div class="form-group text-center">
                                            <button type="submit"
                                                class="btn btn-rounded btn-primary">@lang('site.add')</button>
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
    <script src="{{ asset('dashboard/assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Select 2 init -->
    <script src="{{ asset('dashboard/assets/js/plugins-init/select2-init.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom-init/select2-init.js') }}"></script>
@endpush
