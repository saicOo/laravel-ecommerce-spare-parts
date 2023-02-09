@extends('dashboard.layouts.app')
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.admins') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12 col-xl-7">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">@lang('site.edit') @lang('site.admin')</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.admins.update',$admin->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.name')</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $admin->name }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.phone')</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $admin->phone }}">
                                        </div>
                                    </div>
                                    @can('check-permissions', 'update_admins')
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.role')</label>
                                            <select class="custom-select mr-sm-2 @error('role') is-invalid @enderror" id="inlineFormCustomSelect" name="role">
                                                <option  value="{{$admin->role}}" disabled selected>@lang('site.'.$admin->role)...</option>
                                                <option value="suber_admin">@lang('site.suber_admin')</option>
                                                <option value="accountant">@lang('site.accountant')</option>
                                                <option value="customer_service">@lang('site.customer_service')</option>
                                                <option value="data_entry">@lang('site.data_entry')</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endcan
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.current') @lang('site.password')</label>
                                            <input type="password" class="form-control disabled-password" name="current_password" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.new') @lang('site.password')</label>
                                            <input type="password" class="form-control disabled-password @error('password') is-invalid @enderror" name="password" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>@lang('site.password_confirmation')</label>
                                            <input type="password" class="form-control disabled-password" name="password_confirmation" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input id="checkbox-password" type="checkbox">
                                                <label for="checkbox-password" class="form-check-label">@lang('site.update')
                                                    @lang('site.password')</label>
                                            </div>
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
    $(document).ready(function() {
        $("body").on("change", "#checkbox-password", function() {
            let deleteId = $(this).val();
            if ($(this).prop("checked")) {
                $(".disabled-password").each(function(index) {
                    $(this).attr("disabled", false);
                });
            } else {
                $(".disabled-password").each(function(index) {
                    $(this).attr("disabled", true);
                });
            }
        }); //end of inputs check box change
    });
</script>
@endpush
