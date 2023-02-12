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
                        @foreach ($errors->all() as $message)
                        <ul>
                            <li>{{$message}}</li>
                        </ul>
                        @endforeach
                        <div class="mb-4 box box-login">
                            <form method="post" action="{{route('login')}}" class="login-form">
                                @csrf
                                <h3 class="title text-uppercase">Log in Your Account</h3>
                                <p class="mb-3">If you have an account with us, please log in.</p>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="{{__('site.email')}}*" id="CustomerEmail" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <div class="form-group">
                                            <input type="password" value="" name="password" placeholder="{{__('site.password')}}*" id="CustomerPassword" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <label>
                                            <input class="d-inline-block align-middle mb-0 mt-0 margin-5px-right form-check-input" type="checkbox" name="account">
                                            <span class="d-inline-block align-middle mx-2">Keep me logged in</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-left col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                                        <input type="submit" class="btn rounded btn-primary btn-lg" value="Login">
                                        <p class="m-0">
                                            <a href="forgot-password.html">Forgot your password?</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                        <div class="box box-register">
                            <form method="post" action="{{ route('register') }}" class="register-form">
                                @csrf
                                <h3 class="title text-uppercase">Don't have an account? Register Now</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>

                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                        <div class="form-group">
                                            <input id="CustomerFirstName" type="text" name="first_name" placeholder="{{__('site.first_name')}}*" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                        <div class="form-group">
                                            <input id="CustomerLastName" type="text" name="last_name" placeholder="{{__('site.last_name')}}*" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <div class="form-group">
                                            <input id="CustomerEmail1" type="email" name="email" placeholder="{{__('site.email')}}*" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                        <div class="form-group">
                                            <input id="CustomerPassword1" type="password" name="password" placeholder="{{__('site.password')}}*" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                        <div class="form-group">
                                            <input id="CustomerConfirmPassword" type="Password" name="password_confirmation" placeholder="{{__('site.password_confirmation')}}*" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-start col-12 col-sm-12 col-md-6 col-lg-6">
                                        <input type="submit" class="btn btn-lg btn-primary rounded" value="Register Now">
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
