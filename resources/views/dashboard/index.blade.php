@extends('dashboard.layouts.app')
@push('css')
    {{-- <!-- Custom Stylesheet -->
<link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/owl.carousel/dist/css/owl.carousel.min.css') }}">
<link href="{{ asset('dashboard/assets/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet') }}"> --}}
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/chartist/css/chartist.min.css') }}">
@endpush
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
                <div class="col-12">
                    <div class="row">
                        <!-- start card admins -->
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card text-white bg-primary pb-2">
                                <div class="card-body pb-0">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <h4 class="text-muted mb-3">@lang('site.admins')</h4>
                                        </div>
                                        <div class="col-auto">
                                            <h2 class="text-white">{{ $admins_count }}</h2>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <i class="text-muted icon-user" style="font-size: 60px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card admins -->
                        <!-- start card clients -->
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card text-white bg-primary pb-2">
                                <div class="card-body pb-0">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <h4 class="text-muted mb-3">@lang('site.clients')</h4>
                                        </div>
                                        <div class="col-auto">
                                            <h2 class="text-white">{{ $clients_count }}</h2>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <i class="text-muted icon-user" style="font-size: 60px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card clients -->
                        <!-- start card orders -->
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card text-white bg-primary pb-2">
                                <div class="card-body pb-0">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <h4 class="text-muted mb-3">@lang('site.orders')</h4>
                                        </div>
                                        <div class="col-auto">
                                            <h2 class="text-white">{{ $orders_count }}</h2>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <i class="text-muted icon-basket" style="font-size: 60px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card orders -->
                        <!-- start card products -->
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card text-white bg-primary pb-2">
                                <div class="card-body pb-0">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <h4 class="text-muted mb-3">@lang('site.products')</h4>
                                        </div>
                                        <div class="col-auto">
                                            <h2 class="text-white">{{ $products_count }}</h2>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <i class="text-muted icon-puzzle" style="font-size: 60px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card products -->
                        <!-- start card categories -->
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card text-white bg-primary pb-2">
                                <div class="card-body pb-0">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <h4 class="text-muted mb-3">@lang('site.categories')</h4>
                                        </div>
                                        <div class="col-auto">
                                            <h2 class="text-white">{{ $categories_count }}</h2>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <i class="text-muted icon-organization" style="font-size: 60px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card categories -->
                        <!-- start card brands -->
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card text-white bg-primary pb-2">
                                <div class="card-body pb-0">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <h4 class="text-muted mb-3">@lang('site.brands')</h4>
                                        </div>
                                        <div class="col-auto">
                                            <h2 class="text-white">{{ $brands_count }}</h2>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <i class="text-muted icon-tag" style="font-size: 60px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card brands -->
                        <!-- start card sales -->
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="card text-white bg-primary pb-2">
                                <div class="card-body pb-0">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <h4 class="text-muted mb-3">@lang('site.sales')</h4>
                                        </div>
                                        <div class="col-auto">
                                            <h2 class="text-white">${{ number_format($total_sales, 2) }}</h2>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <i class="text-muted fa fa-money" style="font-size: 60px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card sales -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">@lang('site.amount')</h4>
                            <canvas id="amountChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">@lang('site.count')</h4>
                            <canvas id="countChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- ChartJS -->
    <script src="{{ asset('dashboard/assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- MorrisJS -->
    <script src="{{ asset('dashboard/assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/morris/morris.min.js') }}"></script>
    <!-- Chartist -->
    <script src="{{ asset('dashboard/assets/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}">
    </script>


    <script>
        const ctxc = document.getElementById('countChart');
        new Chart(ctxc, {
            type: 'line',
            data: {
                labels: [
                    @foreach ($reports as $report)
                        '{{ $report->created_at->format('M d') }}',
                    @endforeach
                ],
                datasets: [{
                        label: '# purchases',
                        data: [
                            @foreach ($reports as $report)
                                {{ $report->purchases_count }},
                            @endforeach
                        ],
                        borderColor: '#fa5c7c',
                        backgroundColor: '#fa5c7c7d',
                        borderWidth: 1
                    },
                    {
                        label: '# orders',
                        data: [
                            @foreach ($reports as $report)
                                {{ $report->orders_count }},
                            @endforeach
                        ],
                        borderColor: '#0acf97',
                        backgroundColor: '#0acf976b',
                        borderWidth: 1
                    },

                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        const ctxa = document.getElementById('amountChart');
        new Chart(ctxa, {
            type: 'line',
            data: {
                labels: [
                    @foreach ($reports as $report)
                        '{{ $report->created_at->format('M d') }}',
                    @endforeach
                ],
                datasets: [{
                        label: '# purchases',
                        data: [
                            @foreach ($reports as $report)
                                {{ $report->purchases_amount }},
                            @endforeach
                        ],
                        borderColor: '#fa5c7c',
                        backgroundColor: '#fa5c7c7d',
                        borderWidth: 1
                    },
                    {
                        label: '# orders',
                        data: [
                            @foreach ($reports as $report)
                                {{ $report->orders_amount }},
                            @endforeach
                        ],
                        borderColor: '#0acf97',
                        backgroundColor: '#0acf976b',
                        borderWidth: 1
                    },

                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
