@extends('dashboard.layouts.app')
@push('css')
    <!-- Summernote -->
    <link href="{{ asset('dashboard/assets/plugins/summernote/summernote.css') }}" rel="stylesheet">
    <!-- Dropify -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.products') }}</a></li>
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
                            <h4 class="card-title">@lang('site.create') @lang('site.product')</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.products.store') }}"
                                enctype="multipart/form-data">
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
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>@lang('site.stock')</label>
                                            <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                                name="stock" value="{{ old('stock') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>@lang('site.purchase_price')</label>
                                            <input type="number" class="form-control @error('purchase_price') is-invalid @enderror"
                                                name="purchase_price" value="{{ old('purchase_price') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>@lang('site.sale_price')</label>
                                            <input type="number" class="form-control @error('price') is-invalid @enderror"
                                                name="price" value="{{ old('price') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.country')</label>
                                            <select class="single-select @error('country') is-invalid @enderror"
                                                name="country" id="country">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.category')</label>
                                            <select name="category_id"
                                                class="dropdown-groups @error('category_id') is-invalid @enderror">
                                                <option value="" disabled selected>@lang('site.choose')
                                                    @lang('site.category')...
                                                    @foreach ($primary_categories as $primary_category)
                                                        <optgroup label="{{ $primary_category->name }}">
                                                            @foreach ($primary_category->subCategories as $sub_category)
                                                                <option value="{{ $sub_category->id }}"
                                                                    {{ old('category_id') == $sub_category->id ? 'selected' : '' }}>
                                                                    {{ $sub_category->name }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.brand')</label>
                                            <select class="single-select  @error('brand_id') is-invalid @enderror"
                                                name="brand_id">
                                                <option value="" disabled selected>@lang('site.choose')
                                                    @lang('site.brand')...
                                                </option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                        {{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.choose') @lang('site.car')</label>
                                            <select name="car_id" class="dropdown-groups" id="t_model">
                                                <option value="" disabled selected>@lang('site.choose')
                                                    @lang('site.car')...
                                                </option>
                                                @foreach ($factory_cars as $factory_car)
                                                    <optgroup label="{{ $factory_car->name }}">
                                                        @foreach ($factory_car->cars as $car)
                                                            <option value="{{ $car->id }}">{{ $car->name }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label>@lang('site.ar.description')</label>
                                            <textarea name="description_ar" id="summernote-description-ar">{{ old('description_ar') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label>@lang('site.en.description')</label>
                                            <textarea name="description_en" id="summernote-description-en">{{ old('description_en') }}</textarea>
                                        </div>
                                    </div>
                                    {{-- images area --}}
                                    <div class="col-lg-6 mb-4">
                                        <input type="file" class="dropify" name="images[]" data-default-file="" />
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <input type="file" class="dropify" name="images[]" data-default-file="" />
                                    </div>
                                    <div class="col-lg-6 mb-4 mb-lg-0">
                                        <input type="file" class="dropify" name="images[]" data-default-file="" />
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="file" class="dropify" name="images[]" data-default-file="" />
                                    </div>
                                    <br>
                                    {{-- images area.// --}}
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
    <!-- Summernote -->
    <script src="{{ asset('dashboard/assets/plugins/summernote/js/summernote.min.js') }}"></script>
    <!-- Summernote init -->
    <script src="{{ asset('dashboard/assets/js/custom-init/summernote-init.js') }}"></script>
    <!-- Dropify -->
    <script src="{{ asset('dashboard/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <!-- Dropify init -->
    <script src="{{ asset('dashboard/assets/js/plugins-init/dropify-init.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{ asset('dashboard/assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Select 2 init -->
    <script src="{{ asset('dashboard/assets/js/plugins-init/select2-init.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom-init/select2-init.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // ajax get countries
            $.ajax({
                url: 'https://restcountries.com/v3.1/all',
                dataType: "json",
                method: "get",
                success: function(data) {
                    var countries = [];
                    for (var i = 0; i < data.length; i++) {
                        countries += '<option value="' + data[i].name.common + '">' + data[i].name
                            .common + '</option>';
                    }
                    $("#country").html(countries);
                }
            }); // end ajax get countries
        });
    </script>
@endpush
