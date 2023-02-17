@extends('dashboard.layouts.app')
@push('css')
    <!-- Dropify -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.settings') }}</a></li>
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
                            <h4 class="card-title">@lang('site.edit') @lang('site.settings')</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.settings.update',$setting->id) }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('site.name')</label>
                                            <input type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ $setting->name }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('site.phone')</label>
                                            <input type="text"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                value="{{ $setting->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('site.address')</label>
                                            <input type="text"
                                                class="form-control @error('address') is-invalid @enderror" name="address"
                                                value="{{ $setting->address }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>tax</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="validatedInputGroupPrepend">%</span>
                                              </div>
                                            <input type="number" class="form-control @error('tax') is-invalid @enderror"
                                                name="tax" value="{{ $setting->tax }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('site.shipping')</label>
                                            <input type="number" class="form-control @error('shipping') is-invalid @enderror"
                                                name="shipping" value="{{ $setting->shipping }}">
                                        </div>
                                    </div>



                                    {{-- images area --}}
                                    <div class="col-4">
                                        <label for="">@lang('site.image')</label>
                                        <input type="file" class="dropify" name="image" data-default-file="" />
                                    </div>
                                    <br>
                                    {{-- images area.// --}}

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>payment url</label>
                                            <input type="text"
                                                class="form-control @error('payment_url') is-invalid @enderror" name="payment_url"
                                                value="{{ $setting->payment_url }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>payment token</label>
                                            <input type="text"
                                                class="form-control @error('payment_token') is-invalid @enderror" name="payment_token"
                                                value="{{ $setting->payment_token }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>payment integration id</label>
                                            <input type="text"
                                                class="form-control @error('payment_integration_id') is-invalid @enderror" name="payment_integration_id"
                                                value="{{ $setting->payment_integration_id }}">
                                        </div>
                                    </div>
                                    <div class="col-12 pt-3">
                                        <div class="form-group text-center">
                                            <button type="submit"
                                                class="btn btn-rounded btn-primary">@lang('site.save')</button>
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
    <!-- Dropify -->
    <script src="{{ asset('dashboard/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <!-- Dropify init -->
    <script src="{{ asset('dashboard/assets/js/plugins-init/dropify-init.js') }}"></script>
@endpush
