<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard/assets/images/favicon.png') }}">
    <title>Gleek - Bootstrap Admin Dashboard HTML Template</title>
    <!-- Custom Stylesheet -->
    <link href="{{ asset('dashboard/assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="h-100">
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="login-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-md-5">
                    <div class="form-input-content">
                        <div class="card card-login">
                            <div class="card-header">
                                <div class="nav-header position-relative  text-center w-100">
                                    <div class="brand-logo">
                                        <a href="{{ url('/') }}">
                                            <b class="logo-abbr">D</b>
                                            <span class="brand-title"><b>Drora</b></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('dashboard.login') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <input type="email" name="email"
                                            class="form-control rounded-0 bg-transparent @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" placeholder="Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" name="password"
                                            class="form-control rounded-0 bg-transparent @error('password') is-invalid @enderror"
                                            value="{{ old('password') }}" placeholder="Password">
                                            @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>

                                    <div class="form-group ml-3 mb-5">
                                        <input id="checkbox1" type="checkbox">
                                        <label class="label-checkbox ml-2 mb-0" for="checkbox1">Remember
                                            Password</label>
                                    </div>
                                    <button class="btn btn-primary btn-block border-0" type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
    <!-- Common JS -->
    <script src="{{ asset('dashboard/assets/plugins/common/common.min.js') }}"></script>
    <!-- Custom script -->
    <script src="{{ asset('dashboard/assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/settings.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/quixnav.js') }}"></script>
</body>


</html>
