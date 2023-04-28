@extends('dashboard.layouts.app')

@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.purchases') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.payment') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-6">
                    <!-- card -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('site.invoice') }} {{ __('site.purchases') }} #<a
                                    href="{{ route('dashboard.purchases.show', $purchase->id) }}">{{ $purchase->invoice_no }}</a>
                            </h5>
                            <div class="basic-form">
                                <!-- form start -->
                                <form action="{{ route('dashboard.purchases.update', $purchase->id) }}" method="POST">
                                    {{ csrf_field() }}
                                {{ method_field('put') }}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>@lang('site.amount_paid')</label>
                                                <input type="numebr"
                                                    class="form-control @error('amount_paid') is-invalid @enderror"
                                                    name="amount_paid" value="{{ number_format($purchase->total_price - $purchase->amount_paid, 2) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">@lang('site.add')</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col -->
            </div>
        </div>
    </div>
@endsection
