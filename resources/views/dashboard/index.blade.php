@extends('dashboard.layouts.app')
@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="row">
                    <div class="col-sm-6 col-xxl-6 col-xl-6">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <h4 class="text-muted mb-3">Order</h4>
                                    </div>
                                    <div class="col-auto">
                                        <h2>2,250</h2>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-success"><i class="mdi mdi-arrow-up-bold"></i> 6.365% </span>
                                    <p> Since last month</p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <div id="home_chart_widget_1" class="home_chart_widget chart-one"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xxl-6 col-xl-6">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <h4 class="text-muted mb-3">Pending</h4>
                                    </div>
                                    <div class="col-auto">
                                        <h2>2,250</h2>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-danger"><i class="mdi mdi-arrow-down-bold"></i> 2.65% </span>
                                    <p> Since last month</p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <div id="home_chart_widget_2" class="home_chart_widget chart-two"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xxl-6 col-xl-6">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <h4 class="text-muted mb-3">Revenue</h4>
                                    </div>
                                    <div class="col-auto">
                                        <h2>$2,250</h2>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-danger"><i class="mdi mdi-arrow-down-bold"></i> 23.65% </span>
                                    <p> Since last month</p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <div id="home_chart_widget_3" class="home_chart_widget chart-three"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xxl-6 col-xl-6">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <h4 class="text-muted mb-3">Expense</h4>
                                    </div>
                                    <div class="col-auto">
                                        <h2>$ 1,475</h2>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-success"><i class="mdi mdi-arrow-up-bold"></i> 47.5% </span>
                                    <p> Since last month</p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <div id="home_chart_widget_4" class="home_chart_widget chart-four"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                            <h4 class="card-title mb-4">Earnings</h4>
                        <canvas id="earnings_bar_chart"></canvas>
                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                            <h4 class="card-title">Restaurent Rating</h4>
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs justify-content-end">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#success1">Graph</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#info1">Review</a></li>
                            </ul>
                            <div class="tab-content tab-content-default">
                                <div class="tab-pane fade active show" id="success1" role="tabpanel">
                                    <div class="row justify-content-between">
                                        <div class="col-md-6">
                                            <canvas id="user_rating_graph"></canvas>
                                        </div>
                                        <div class="col-md-5">
                                            <div>
                                                <div class="d-flex justify-content-between">
                                                    <p>Food</p>
                                                    <p><b class="text-dark">220 </b> (10%)</p>
                                                </div>
                                                <div class="progress mt-2" style="height: 9px;">
                                                    <div class="progress-bar bg-primary" style="width: 50%;" role="progressbar"><span class="sr-only">50% Complete</span></div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between">
                                                    <p>Service</p>
                                                    <p><b class="text-dark">420</b> (40%)</p>
                                                </div>
                                                <div class="progress mt-2" style="height: 9px;">
                                                    <div class="progress-bar bg-info" style="width: 50%;" role="progressbar"><span class="sr-only">50% Complete</span></div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between">
                                                    <p>Waiting Time</p>
                                                    <p><b class="text-dark">260</b> (30%)</p>
                                                </div>
                                                <div class="progress mt-2" style="height: 9px;">
                                                    <div class="progress-bar bg-success" style="width: 50%;" role="progressbar"><span class="sr-only">50% Complete</span></div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between">
                                                    <p>Others</p>
                                                    <p><b class="text-dark">460</b> (20%)</p>
                                                </div>
                                                <div class="progress mt-2" style="height: 9px;">
                                                    <div class="progress-bar bg-dark" style="width: 50%;" role="progressbar"><span class="sr-only">50% Complete</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="info1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="media">
                                                <img src="{{asset('dashboard/assets/images/avatar/1.jpg')}}" width="35" alt="reviewer">
                                                <div class="media-body ml-4">
                                                    <div class="d-flex justify-content-between">
                                                        <strong>Antony Jonus</strong>
                                                        <div class="vertical-card__menu--rating c-pointer">
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star-o"></i></span>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorem, voluptatibus!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="media mt-4">
                                                <img src="{{asset('dashboard/assets/images/avatar/2.jpg')}}" width="35" alt="reviewer">
                                                <div class="media-body ml-4">
                                                    <div class="d-flex justify-content-between">
                                                        <strong>Antony Jonus</strong>
                                                        <div class="vertical-card__menu--rating c-pointer">
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star-o"></i></span>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorem, voluptatibus!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="media mt-4">
                                                <img src="{{asset('dashboard/assets/images/avatar/1.jpg')}}" width="35" alt="reviewer">
                                                <div class="media-body ml-4">
                                                    <div class="d-flex justify-content-between">
                                                        <strong>Antony Jonus</strong>
                                                        <div class="vertical-card__menu--rating c-pointer">
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star-o"></i></span>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorem, voluptatibus!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="media mt-4">
                                                <img src="{{asset('dashboard/assets/images/avatar/2.jpg')}}" width="35" alt="reviewer">
                                                <div class="media-body ml-4">
                                                    <div class="d-flex justify-content-between">
                                                        <strong>Antony Jonus</strong>
                                                        <div class="vertical-card__menu--rating c-pointer">
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star"></i></span>
                                                            <span class="icon"><i class="fa fa-star-o"></i></span>
                                                        </div>
                                                    </div>
                                                    <p>
                                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorem, voluptatibus!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Visit Hour</h4>
                        <div class="row mb-3 mt-4">
                            <div class="col text-center">
                                <p class="mb-2 text-dark">Day</p>
                                <h4><span class="text-success mdi mdi-arrow-up-bold"></span> 82.24 %</h4>
                            </div>
                            <div class="col text-center">
                                <p class="mb-2 text-dark">Night</p>
                                <h4><span class="text-danger mdi mdi-arrow-down-bold"></span> 12.24 %</h4>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="visitor_graph"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('js')
{{-- <!-- Datamap -->
<script src="{{asset('dashboard/assets/plugins/d3v3/index.js')}}"></script>
<script src="{{asset('dashboard/assets/plugins/topojson/topojson.min.js')}}"></script>
<script src="{{asset('dashboard/assets/plugins/datamaps/datamaps.world.min.js')}}"></script>
<!-- Calender -->
<script src="{{asset('dashboard/assets/plugins/jqueryui/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('dashboard/assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('dashboard/assets/plugins/fullcalendar/js/fullcalendar.min.js')}}"></script> --}}
<!-- ChartJS -->
<script src="{{asset('dashboard/assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- MorrisJS -->
<script src="{{asset('dashboard/assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('dashboard/assets/plugins/morris/morris.min.js')}}"></script>
<!-- Chartist -->
<script src="{{asset('dashboard/assets/plugins/chartist/js/chartist.min.js')}}"></script>
<script src="{{asset('dashboard/assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js')}}"></script>


<!-- Init files -->
<script src="{{asset('dashboard/assets/js/plugins-init/fullcalendar-init.js')}}"></script>
<script src="{{asset('dashboard/assets/js/dashboard/dashboard-1.js')}}"></script>
@endpush

