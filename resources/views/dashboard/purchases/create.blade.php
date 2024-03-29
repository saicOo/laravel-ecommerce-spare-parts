@extends('dashboard.layouts.app')
@push('css')
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/select2/css/select2.min.css') }}">
    <!-- Touchspinner -->
    <link rel="stylesheet"
        href="{{ asset('dashboard/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}">
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
                            <h4 class="card-title">@lang('site.create') @lang('site.purchases')</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.purchases.store') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>@lang('site.supplier')</label>
                                            <select class="single-select @error('supplier') is-invalid @enderror"
                                                name="supplier">
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>@lang('site.type')</label>
                                            <select class="form-control @error('payment_type') is-invalid @enderror"
                                                name="payment_type" id="payment-type">
                                                <option value="1">@lang('site.new')</option>
                                                <option value="2">@lang('site.return')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>@lang('site.status')</label>
                                            <select class="form-control @error('payment_status') is-invalid @enderror"
                                                name="payment_status">
                                                <option value="1">@lang('site.cash')</option>
                                                <option value="2">@lang('site.defrred')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row align-items-center">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.product')</label>
                                            <select id="product-ajax" data-url-products="{{ route('api-product.index') }}"
                                                data-url-show="{{ route('api-product.show', ':productId') }}"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <label>@lang('site.price')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                                <span class="input-group-text">0.00</span>
                                            </div>
                                            <input type="text" class="form-control" id="price">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('site.quantity')</label>
                                            <input class="qyt" id="qyt" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 text-center">
                                        <div class="form-group">
                                            <input type="button" value="{{ __('site.add') }}"
                                                class="btn btn-rounded btn-primary mt-4" id="add-product"
                                                data-url="{{ route('api-product.show', ':productId') }}">
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered verticle-middle table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">@lang('site.product')</th>
                                                        <th scope="col">@lang('site.price')</th>
                                                        <th scope="col">@lang('site.quantity')</th>
                                                        <th scope="col">@lang('site.subTotal')</th>
                                                        <th scope="col">@lang('site.delete')</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="purchaseList">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="col-sm-4">
                                        <h5>@lang('site.total'): $<span id="total-price">0.00</span></h5>
                                    </div>
                                    <div class="col-12 pt-3">
                                        <div class="form-group text-center">
                                            <button type="submit" id="add-form-btn" class="btn btn-rounded btn-primary "
                                                disabled>@lang('site.add')</button>
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
    <!-- Touchspinner -->
    <script src="{{ asset('dashboard/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}">
    </script>
    <!-- Select 2 init -->
    <script src="{{ asset('dashboard/assets/js/plugins-init/select2-init.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom-init/select2-init.js') }}"></script>
    <script src="{{ asset('assets/js/select2-product-ajax.js') }}"></script>
    <script src="{{ asset('assets/js/purchases.js') }}"></script>
    <!-- Touchspinner init -->
    <script>
        $(".qyt").TouchSpin({
            initval: 1,
            min: 1,
            max: null,
        });
    </script>
@endpush
