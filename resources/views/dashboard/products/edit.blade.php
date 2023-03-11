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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.edit') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">@lang('site.edit') @lang('site.product')</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.products.update',$product->id) }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.ar.name')</label>
                                            <input type="text"
                                                class="form-control @error('name_ar') is-invalid @enderror" name="name_ar"
                                                value="{{ $product->name_ar }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.en.name')</label>
                                            <input type="text"
                                                class="form-control @error('name_en') is-invalid @enderror" name="name_en"
                                                value="{{ $product->name_en }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>@lang('site.stock')</label>
                                            <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                                name="stock" value="{{ $product->stock }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>@lang('site.purchase_price')</label>
                                            <input type="number" class="form-control @error('purchase_price') is-invalid @enderror"
                                                name="purchase_price" value="{{ $product->purchase_price }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>@lang('site.sale_price')</label>
                                            <input type="number" class="form-control @error('price') is-invalid @enderror"
                                                name="price" value="{{ $product->price }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>@lang('site.country')</label>
                                            <input type="text"
                                                class="form-control @error('country') is-invalid @enderror" name="country"
                                                value="{{ $product->country }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.category')</label>
                                            <select  name="category_id" class="dropdown-groups @error('category_id') is-invalid @enderror">
                                                <option value="" disabled>@lang('site.choose') @lang('site.category')...
                                                @foreach ($primary_categories as $primary_category)
                                                <optgroup label="{{ $primary_category->name }}">
                                                    @foreach ($primary_category->subCategories as $sub_category)
                                                    <option value="{{$sub_category->id}}" {{ $product->category->id  == $sub_category->id ? 'selected':''}}>{{ $sub_category->name }}</option>
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
                                                <option value="" disabled>@lang('site.choose') @lang('site.brand')...
                                                </option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{$product->brand->id === $brand->id ?'selected':''}}>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input id="checkbox-car" type="checkbox">
                                                <label for="checkbox-car" class="form-check-label">@lang('site.add')
                                                    @lang('site.car')</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>@lang('site.choose') @lang('site.car')</label>
                                            <select name="car_id" class="dropdown-groups disabled-car" id="t_model" disabled>
                                                <option value="" disabled selected>@lang('site.choose') @lang('site.car')...
                                                </option>
                                                @foreach ($factory_cars as $factory_car)
                                                <optgroup label="{{ $factory_car->name }}">
                                                    @foreach ($factory_car->cars as $car)
                                                    <option value="{{$car->id}}">{{ $car->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.start_year')</label>
                                            <select
                                                class="single-select car-year @error('start_year') is-invalid @enderror"
                                                name="start_year" disabled>
                                                <option value="" disabled selected>@lang('site.choose') @lang('site.year')...
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.end_year')</label>
                                            <select
                                                class="single-select car-year @error('end_year') is-invalid @enderror"
                                                name="end_year" disabled>
                                                <option value="" disabled selected>@lang('site.choose') @lang('site.year')...
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label>@lang('site.ar.description')</label>
                                            <textarea name="description_ar" id="summernote-description-ar">{{ $product->description_ar }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label>@lang('site.en.description')</label>
                                            <textarea name="description_en" id="summernote-description-en">{{ $product->description_en }}</textarea>
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
                                                class="btn btn-rounded btn-primary">@lang('site.update')</button>
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
    <!-- Dropify -->
    <script src="{{ asset('dashboard/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <!-- Dropify init -->
    <script src="{{ asset('dashboard/assets/js/plugins-init/dropify-init.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{ asset('dashboard/assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Select 2 init -->
    <script src="{{ asset('dashboard/assets/js/plugins-init/select2-init.js') }}"></script>
    <script>
        $(".single-select").select2({});
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("body").on("change", "#checkbox-car", function() {
                let deleteId = $(this).val();
                if ($(this).prop("checked")) {
                    $(".disabled-car").each(function(index) {
                        $(this).attr("disabled", false);
                    });
                } else {
                    $(".disabled-car").each(function(index) {
                        $(this).attr("disabled", true);
                    });
                }
            }); //end of inputs check box change
        });
    </script>
    <script type="text/javascript">
        $('#summernote-description-ar').summernote({
            height: 200
        });
        $('#summernote-description-en').summernote({
            height: 200
        });
    </script>
    <script type="text/javascript">
        $(document).on('change', '#t_model', function() {
            var carId = $(this).val();
            console.log(carId);
            var url = `{{ route('api-car.show', ':carId') }}`;
            url = url.replace(':carId', carId);
            $.ajax({
                url: url,
                dataType: "json",
                method: "get",
                success: function(data) {
                    console.log(data);
                    var years =
                        '<option value="" disabled selected>{{ __('site.choose') }} {{ __('site.year') }}...</option>';
                    var arr = data;
                    for (var i = arr.end_year; i > arr.start_year; i--) {
                        years += '<option value="' + i + '">' + i + '</option>';
                    }
                    $(".car-year").html(years);
                    $(".car-year").attr("disabled", false);
                }
            });
        }); // change car
    </script>
@endpush
