@extends('front.layouts.app')
@section('body')

    <body class="login-page">
    @endsection
    @section('content')
    <main id="page-content">

        <!--Page Banner-->
        <div class="page-banner login-page-banner text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-uppercase">@lang('site.login')/@lang('site.register')</h1>
                        <!--Breadcrums-->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">@lang('site.home')</a> <span><i class="cps cp-caret-right"></i></span></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('site.login')/@lang('site.register')</li>
                            </ol>
                        </nav>
                        <!--End Breadcrums-->
                    </div>
                </div>
            </div>
        </div>
        <!--End Page Banner-->

        <div class="section login-page-in">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="mb-4 box box-login">
                            <form method="post" action="{{route('login')}}" class="login-form">
                                @csrf
                                <h3 class="title text-uppercase">@lang('site.Log in Your Account')</h3>
                                <p class="mb-3">@lang('site.have_account')</p>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="{{__('site.email')}}*" id="CustomerEmail" class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <div class="form-group">
                                            <input type="password" value="" name="password" placeholder="{{__('site.password')}}*" id="CustomerPassword" class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <label>
                                            <input class="d-inline-block align-middle mb-0 mt-0 margin-5px-right form-check-input" type="checkbox" name="remember">
                                            <span class="d-inline-block align-middle mx-2">{{ __('site.Remember Me') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-left col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                                        <input type="submit" class="btn rounded btn-primary btn-lg" value="{{__('site.login')}}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                        <div class="box box-register">
                            <form method="post" action="{{ route('register') }}" class="register-form">
                                @csrf
                                <h3 class="title text-uppercase">@lang('site.account?') @lang('site.register_now')</h3>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                        <div class="form-group">
                                            <input id="CustomerFirstName" type="text" name="first_name" placeholder="{{__('site.first_name')}}*" class="form-control @error('first_name') is-invalid @enderror">
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                        <div class="form-group">
                                            <input id="CustomerLastName" type="text" name="last_name" placeholder="{{__('site.last_name')}}*" class="form-control @error('last_name') is-invalid @enderror">
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <div class="form-group">
                                            <input id="CustomerEmail1" type="email" name="email" placeholder="{{__('site.email')}}*" class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                        <div class="form-group">
                                            <input id="CustomerPassword1" type="password" name="password" placeholder="{{__('site.password')}}*" class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                        <div class="form-group">
                                            <input id="CustomerConfirmPassword" type="Password" name="password_confirmation" placeholder="{{__('site.password_confirmation')}}*" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-start col-12 col-sm-12 col-md-6 col-lg-6">
                                        <input type="submit" class="btn btn-lg btn-primary rounded" value="{{__('site.register_now')}}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    @endsection
