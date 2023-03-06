@extends('dashboard.layouts.app')
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.suppliers') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 col-xl-7">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">@lang('site.edit') @lang('site.supplier')</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.suppliers.update',$supplier->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.name')</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $supplier->name }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.phone')</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $supplier->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.status')</label>
                                            <select class="form-control @error('account_status') is-invalid @enderror"
                                                name="account_status" id="account-status">
                                                <option disabled selected>@lang('site.select') @lang('site.status')</option>
                                                <option value="2">@lang('site.debit')</option>
                                                <option value="1">@lang('site.credit')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.amount_paid')</label>
                                            <input type="numebr" class="form-control @error('amount_paid') is-invalid @enderror" id="current-account" name="amount_paid" value="{{ old('amount_paid') }}" disabled>
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
<script type="text/javascript">
    $(document).on('change', '#account-status', function() {
        var accountStatus = $(this).val();
        if(accountStatus == 1 || accountStatus == 2){
            $("#current-account").attr("disabled", false);
        }else{
            $("#current-account").attr("disabled", true);
        }
    }); // change car
</script>
@endpush
