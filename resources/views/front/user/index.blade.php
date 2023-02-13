@extends('front.layouts.app')
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
                            <h1 class="text-uppercase">My Accounts</h1>
                            <!--Breadcrums-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center mb-0">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a> <span><i
                                                class="cps cp-caret-right"></i></span></li>
                                    <li class="breadcrumb-item active" aria-current="page">My Accounts</li>
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
                    <div class="row justify-content-between">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="nav-box mb-4">
                                <div class="profile-content">
                                    <div class="d-flex align-items-center mb-4">
                                        <img class="blur-up lazyload rounded-pill" src="assets/images/photo1.jpg"
                                            data-src="assets/images/photo1.jpg" alt="" title="" />
                                        <div class="detail mx-3">
                                            <h3 class="text-uppercase mb-0">{{ $user->first_name . ' '. $user->last_name }}</h3>
                                            <p class="mb-0">@lang('site.joined') {{ $user->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Nav tabs -->
                                <ul class="nav flex-column dashboard-list" role="tablist">
                                    <li><a class="nav-link active" data-bs-toggle="tab" href="#orders">Orders</a></li>
                                    <li><a class="nav-link" data-bs-toggle="tab" href="#profile">Profile</a></li>
                                    <li><a class="nav-link" data-bs-toggle="tab" href="#address">Addresses</a></li>
                                    <li><a class="nav-link" href="login-register.html">Logout</a></li>
                                </ul>
                                <!-- End Nav tabs -->
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard-content">
                                <!-- Orders -->
                                <div id="orders" class="product-order tab-pane fade active show">
                                    <h3>Orders</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="alt-font">
                                                <tr>
                                                    <th>Order #</th>
                                                    <th>Product</th>
                                                    <th>Date</th>
                                                    <th class="status">Status</th>
                                                    <th>Total</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>001</td>
                                                    <td>Hankook DynaPro AT-m RF10</td>
                                                    <td>March 04, 2018</td>
                                                    <td class="alert-danger">Canceled</td>
                                                    <td>$165.00</td>
                                                    <td class="text-center"><a class="view" href="#;"><u>View</u></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>014</td>
                                                    <td>Carbon Steering Wheel</td>
                                                    <td>May 19, 2018</td>
                                                    <td class="alert-primary">In progress</td>
                                                    <td>$150.00</td>
                                                    <td class="text-center"><a class="view" href="#;"><u>View</u></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>016</td>
                                                    <td>Air Filter</td>
                                                    <td>May 19, 2018</td>
                                                    <td class="alert-warning">Delayed</td>
                                                    <td>$79.00</td>
                                                    <td class="text-center"><a class="view" href="#;"><u>View</u></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>085</td>
                                                    <td>Adapter Car Hands</td>
                                                    <td>May 19, 2018</td>
                                                    <td class="alert-success">Delivered</td>
                                                    <td>$99.00</td>
                                                    <td class="text-center"><a class="view" href="#;"><u>View</u></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>099</td>
                                                    <td>Road Warrior Hub pilot</td>
                                                    <td>May 19, 2018</td>
                                                    <td class="alert-success">Delivered</td>
                                                    <td>$69.00</td>
                                                    <td class="text-center"><a class="view" href="#;"><u>View</u></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End Orders -->

                                <!-- profile -->
                                <div id="profile" class="product-order tab-pane fade">
                                    <h3>Profile</h3>
                                    <form method="post" action="{{ route('users.update', Auth::user()->id) }}"
                                        class="profile-form">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="CustomerFirstName">@lang('site.first_name')</label>
                                                    <input id="CustomerFirstName" type="text" name="first_name"
                                                        placeholder="First Name"
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
                                                        placeholder="Last Name"
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
                                                        placeholder="Email Address" class="form-control"
                                                        value="{{ $user->email }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="phone">@lang('site.phone')</label>
                                                    <input id="phone" type="text" name="phone"
                                                        placeholder="Phone Number"
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
                                                        name="current_password" placeholder="Password"
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
                                                        placeholder="Password"
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
                                                        name="password_confirmation" placeholder="Confirm Password"
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
                                                    name="updateProfile" value="Update Profile">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- End profile -->

                                <!-- Address -->
                                <div id="address" class="address tab-pane">
                                    <h3>Contact Address</h3>
                                    <form method="post" action="{{ route('users.update', Auth::user()->id) }}"
                                        class="profile-form">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="row">

                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <label for="address_governorate" class="form-label">@lang('site.governorate')
                                                    <span class="required">*</span></label>
                                                <select id="address_governorate" name="governorate"
                                                    data-default="United States"
                                                    class="form-control  @error('governorate') is-invalid @enderror">
                                                    <option value="" label="Select a country" selected="selected">
                                                        Select a country</option>
                                                        <option value="vdsf" {{$user->governorate == 'vdsf' ? 'selected' : ''}}>vdsf</option>
                                                        <option value="fjfjfhj" {{$user->governorate == 'fjfjfhj' ? 'selected' : ''}}>fjfjfhj</option>
                                                        <option value="Algerfia" {{$user->governorate == 'Algerfia' ? 'selected' : ''}}>Algerfia</option>
                                                </select>
                                                @error('governorate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <label for="address_city" class="form-label">Town / City <span
                                                        class="required">*</span></label>
                                                <select id="address_city" name="city" data-default=""
                                                    class="form-control @error('city') is-invalid @enderror">
                                                    <option value="" label="Select a city" selected="selected">
                                                        Select a city</option>
                                                    <option value="AR" {{$user->city == 'AR' ? 'selected' : ''}}>AR</option>
                                                    <option value="CA" {{$user->city == 'CA' ? 'selected' : ''}}>CA</option>
                                                    <option value="DE" {{$user->city == 'DE' ? 'selected' : ''}}>DE</option>
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
                                                        class="form-control @error('street') is-invalid @enderror"
                                                        placeholder="street">
                                                    @error('street')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="input-build-num" class="form-label">@lang('site.build_num')
                                                        <span class="required">*</span></label>
                                                    <input name="build_num" value="{{ $user->build_num }}"
                                                        id="input-build-num" type="text"
                                                        class="form-control @error('build_num') is-invalid @enderror"
                                                        placeholder="build number">
                                                    @error('build_num')
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
                                                        class="form-label">@lang('site.apartment_num')</label>
                                                    <input name="apartment_num" value="{{ $user->apartment_num }}"
                                                        id="input-apartment-num" type="text"
                                                        placeholder="apartment number"
                                                        class="form-control @error('apartment_num') is-invalid @enderror">
                                                    @error('apartment_num')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <div class="form-group">
                                                    <label for="input-floor-num"
                                                        class="form-label">@lang('site.floor_num')</label>
                                                    <input name="floor_num" value="{{ $user->floor_num }}"
                                                        id="input-floor-num" type="text" placeholder="floor-number"
                                                        class="form-control @error('floor_num') is-invalid @enderror">
                                                    @error('floor_num')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center justify-content-between">
                                            {{-- <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-2">
                                            <div class="customCheckbox form-check clearfix">
                                                <input id="saddress" name="saddress" type="checkbox" class="form-check-input">
                                                <label for="saddress" class="mx-2">Same as contact address</label>
                                            </div>
                                        </div> --}}
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-end">
                                                <input type="submit" class="btn btn-lg btn-primary rounded-pill"
                                                    name="updateAddress" value="Update Address">
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
