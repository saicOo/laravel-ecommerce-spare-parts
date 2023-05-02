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
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.categories') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.create') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 col-xl-7">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">@lang('site.create') @lang('site.category')</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.categories.store') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.ar.name')</label>
                                            <input type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ old('name_ar') }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.en.name')</label>
                                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en') }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.type')</label>
                                            <select class="single-select mr-sm-2 @error('category_type') is-invalid @enderror" name="category_type">
                                                <option  value="" disabled selected>@lang('site.choose') @lang('site.type')...</option>
                                                <option value="primary_category" {{ old('category_type') == 'primary_category' ? 'selected':''}}>@lang('site.primary_category')</option>
                                                <option value="sub_category" {{ old('category_type') == 'sub_category' ? 'selected':''}}>@lang('site.sub_category')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.category')</label>
                                            <select  name="category_id" class="single-select mr-sm-2 @error('category_id') is-invalid @enderror">
                                                <option value="" disabled selected>@lang('site.choose') @lang('site.category')...
                                                @foreach ($primary_categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected':''}}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-rounded btn-primary">@lang('site.add')</button>
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
