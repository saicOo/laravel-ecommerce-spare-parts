@extends('front.layouts.app')
@push('meta')
<meta name="address-governorates" content="{{ asset('assets/json/governorates.json') }}">
<meta name="address-governorate" content="{{$user->governorate}}">
<meta name="address-city" content="{{$user->city}}">
@endpush
@section('body')

    <body class="login-page">
    @endsection
    @section('content')
        <main id="page-content">

            <!--Page Banner-->
            <div class="page-banner categories-page-banner text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="text-uppercase">@lang('site.my_account')</h1>
                            <!--Breadcrums-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center mb-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('site.home')</a> <span><i
                                                class="cps cp-caret-right"></i></span></li>
                                    <li class="breadcrumb-item active" aria-current="page">@lang('site.my_account')</li>
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
                    @if (session('success'))
                            <div class="alert alert-success" role="alert"><i class="cp cp-lg cp-check-circle"></i> <span
                                    class="mx-2">{{ session('success') }}</span></div>
                        @endif
                    <div class="row justify-content-between">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="nav-box mb-4">
                                <div class="profile-content">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="detail mx-3">
                                            <h3 class="text-uppercase mb-0">{{ $user->first_name . ' ' . $user->last_name }}
                                            </h3>
                                            <p class="mb-0">@lang('site.joined') {{ $user->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Nav tabs -->
                                <ul class="nav flex-column dashboard-list" role="tablist">
                                    <li><a class="nav-link active" data-bs-toggle="tab" href="#orders">@lang('site.orders')</a>
                                    </li>
                                    <li><a class="nav-link" data-bs-toggle="tab" href="#profile">@lang('site.profile')</a></li>
                                    <li><a class="nav-link" data-bs-toggle="tab" href="#address">@lang('site.address')</a></li>
                                    <li><a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                  document.getElementById('logout-form-prof').submit();">@lang('site.logout')</a>
                                        <form id="logout-form-prof" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                                <!-- End Nav tabs -->
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard-content">
                                <!-- Orders -->
                                <div id="orders" class="product-order tab-pane fade active show">
                                    <h3>@lang('site.orders')</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="alt-font">
                                                <tr>
                                                    <th>@lang('site.order') #</th>
                                                    <th>@lang('site.date')</th>
                                                    <th class="status">@lang('site.status')</th>
                                                    <th>@lang('site.method')</th>
                                                    <th>@lang('site.total')</th>
                                                    <th class="text-center">@lang('site.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>#{{ $order->invoice_no }}</td>
                                                        <td>{{ $order->updated_at->format('M d, Y') }}</td>
                                                        <td
                                                            class="{{ $order->payment_status == 1 ? 'alert-success' : ($order->payment_status == 2 ? 'alert-warning' : 'alert-danger') }}">
                                                            {{ $order->status }}</td>
                                                        <td>{{ $order->payment_method ? __('site.online') : __('site.cash') }}
                                                        </td>
                                                        <td>${{ number_format($order->total_price, 2) }}</td>
                                                        <td class="text-center"><a class="view"
                                                                href="{{ route('orders.show', $order->id) }}"><u>View</u></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End Orders -->

                                <!-- profile -->
                                <div id="profile" class="product-order tab-pane fade">
                                    <h3>@lang('site.profile')</h3>
                                    <form method="post" action="{{ route('users.update', Auth::user()->id) }}"
                                        class="profile-form">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="CustomerFirstName">@lang('site.first_name')</label>
                                                    <input id="CustomerFirstName" type="text" name="first_name"
                                                        class="form-control  @error('first_name') is-invalid @enderror"
                                                        value="{{ $user->first_name }}">
                                                    @error('first_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="CustomerLastName">@lang('site.last_name')</label>
                                                    <input id="CustomerLastName" type="text" name="last_name"
                                                        class="form-control  @error('last_name') is-invalid @enderror"
                                                        value="{{ $user->last_name }}">
                                                    @error('last_name')
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
                                                    <label for="CustomerEmail1">@lang('site.email')</label>
                                                    <input id="CustomerEmail1" type="email" name="email"
                                                        class="form-control" value="{{ $user->email }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="phone">@lang('site.phone')</label>
                                                    <input id="phone" type="text" name="phone"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        value="{{ $user->phone }}">
                                                    @error('phone')
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
                                                    <label for="CustomerCurrentPassword">@lang('site.current')
                                                        @lang('site.password')</label>
                                                    <input id="CustomerCurrentPassword" type="password"
                                                        name="current_password"
                                                        class="form-control @error('current_password') is-invalid @enderror disabled-password"
                                                        disabled>
                                                    @error('current_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="CustomerPassword">@lang('site.new')
                                                        @lang('site.password')</label>
                                                    <input id="CustomerPassword" type="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror disabled-password"
                                                        disabled>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="CustomerConfirmPassword">@lang('site.password_confirmation')</label>
                                                    <input id="CustomerConfirmPassword" type="Password"
                                                        name="password_confirmation"
                                                        class="form-control disabled-password" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-2">
                                                <div class="customCheckbox form-check clearfix">
                                                    <input id="checkbox-password" type="checkbox" name="check_password"
                                                        class="form-check-input">
                                                    <label for="checkbox-password" class="mx-2">@lang('site.update')
                                                        @lang('site.password')</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-end">
                                                <input type="submit" class="btn btn-lg btn-primary rounded-pill"
                                                    name="updateProfile"
                                                    value="{{ __('site.update') . ' ' . __('site.profile') }}">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- End profile -->

                                <!-- Address -->
                                <div id="address" class="address tab-pane">
                                    <h3>@lang('site.contact_address')</h3>
                                    <form method="post" action="{{ route('users.update', Auth::user()->id) }}"
                                        class="profile-form">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="row">

                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <label for="address_governorate" class="form-label">@lang('site.governorate')
                                                    <span class="required">*</span></label>
                                                    <input type="hidden" name="governorate" id="inputGovernorate" value="{{$user->governorate}}">
                                                <select id="address_governorate"
                                                    class="form-control  @error('governorate') is-invalid @enderror">
                                                </select>
                                                @error('governorate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <label for="address_city" class="form-label">@lang('site.city') <span
                                                        class="required">*</span></label>
                                                <select id="address_city" name="city"
                                                    class="form-control @error('city') is-invalid @enderror">
                                                </select>
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="input-street" class="form-label">@lang('site.street') <span
                                                            class="required">*</span></label>
                                                    <input name="street" value="{{ $user->street }}" id="input-street"
                                                        type="text"
                                                        class="form-control @error('street') is-invalid @enderror">
                                                    @error('street')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="input-build-num" class="form-label">@lang('site.building')
                                                        <span class="required">*</span></label>
                                                    <input name="building" value="{{ $user->building }}"
                                                        id="input-build-num" type="number"
                                                        class="form-control @error('building') is-invalid @enderror">
                                                    @error('building')
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
                                                    <label for="input-apartment-num"
                                                        class="form-label">@lang('site.apartment')</label>
                                                    <input name="apartment" value="{{ $user->apartment }}"
                                                        id="input-apartment-num" type="number"
                                                        class="form-control @error('apartment') is-invalid @enderror">
                                                    @error('apartment')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="input-floor-num"
                                                        class="form-label">@lang('site.floor')</label>
                                                    <input name="floor" value="{{ $user->floor }}"
                                                        id="input-floor-num" type="number"
                                                        class="form-control @error('floor') is-invalid @enderror">
                                                    @error('floor')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center justify-content-between">

                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-end">
                                                <input type="submit" class="btn btn-lg btn-primary rounded-pill"
                                                    name="updateAddress"
                                                    value="{{ __('site.update') . ' ' . __('site.address') }}">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- End Address -->
                            </div>
                            <!-- End Tab panes -->
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endsection
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @if (session('order_success'))
            <script>
                swal("{{ __('site.good_job') }}", "{{ session('order_success') }}", "success");
            </script>
        @endif
        @if (session('order_wrong'))
            <script>
                swal("{{ __('site.oops') }}", "{{ session('order_wrong') }}", "error");
            </script>
        @endif
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
        <script src="{{asset('assets/js/address.js')}}"></script>
    @endpush
