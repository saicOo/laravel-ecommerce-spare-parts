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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.categories') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 col-xl-7">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">@lang('site.edit') @lang('site.category')</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.categories.update',$category->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                @csrf
                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.ar.name')</label>
                                            <input type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ $category->name_ar }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.en.name')</label>
                                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ $category->name_en }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.type')</label>
                                            <select class="single-select mr-sm-2" disabled>
                                                <option value="primary_category" selected >@lang('site.'.$category->category_type)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.category')</label>
                                            <select  disabled class="single-select mr-sm-2">
                                                <option value="" selected>{{ $category->subCategory ? $category->subCategory->name : '' }}</option>
                                            </select>
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
<!-- Select 2 -->
<script src="{{ asset('dashboard/assets/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Select 2 init -->
<script src="{{ asset('dashboard/assets/js/custom-init/select2-init.js') }}"></script>
@endpush
