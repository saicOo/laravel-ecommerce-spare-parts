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
                            <h4 class="card-title">@lang('site.edit') @lang('site.permissions') ({{$admin->name}})</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboard.admins.permissions.update',$admin->id) }}">
                                @csrf
                                <input type="hidden" name="permissions_deleted" id="permission-deleted">
                                {{-- checked --}}
                                <div class="form-row">
                                    @foreach ($permissions as $index => $permission)
                                    <div class="col-3">
                                        <div class="form-group">
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="check-box-permission" id="check1" name="permissions[]" {{$admin->permissions->find($permission->id) ? 'checked':''}}
                                                value="{{$permission->id}}">
                                                <label class="form-check-label" for="check1">{{ __('site.'.explode('_', $permission->name)[0]) }} {{ __('site.'.explode('_', $permission->name)[1]) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-12">
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

