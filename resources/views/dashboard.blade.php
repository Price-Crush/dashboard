@extends('layouts.app')
@section('title', 'الرئيسية')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Dashboard</h2>
                    <div class="breadcrumb-wrapper col-12">

                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="feather icon-settings"></i></button>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a
                            class="dropdown-item" href="#">Email</a><a class="dropdown-item"
                            href="#">Calendar</a></div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="content-body">
        <div class="content-body">
            @canany(['show_numbered_statistics', 'show_financial_statistics'])
             <form action="/admin-panel/dashboard">
            <div class="row" >

                    <div class="col-lg-5 col-md-5 ">
                        <div class="form-group" >
                            <label for=""> From </label>
                            <input type="date" name="from_date" id="" class="form-control"
                                value="{{ $from_date }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 ">
                        <div class="form-group">
                            <label for=""> To </label>
                            <input type="date" name="to_date" id="" class="form-control"
                                value="{{ $to_date }}">
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 mt-2">
                        <input type="submit" value="Submit" class="btn btn-success">
                    </div>
                
            </div>
            </form>
            @endcanany
            <!-- Statistics card section -->
            <section>
                <!-- Stats Vertical Card -->
                @can('show_numbered_statistics')
                <div class="row">
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-success p-50 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-cube"></i>
                                    </div>
                                </div>
                                <h2 class="fw-bolder">{{ $statistics->stores }}</h2>
                                <p class="card-text">Stores</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-info p-50 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-vcard"></i>
                                    </div>
                                </div>
                                <h2 class="fw-bolder">{{ $statistics->merchants }}</h2>
                                <p class="card-text">Merchants</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-danger p-50 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                                <h2 class="fw-bolder">{{ $statistics->customers }}</h2>
                                <p class="card-text">Customers</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-primary p-50 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-bell"></i>
                                    </div>
                                </div>
                                <h2 class="fw-bolder">{{ $statistics->notificationOrders }}</h2>
                                <p class="card-text">Notification Orders</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-success p-50 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-window-restore"></i>
                                    </div>
                                </div>
                                <h2 class="fw-bolder">{{ $statistics->bannerOrders }}</h2>
                                <p class="card-text">Banner Orders</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-warning p-50 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-tags"></i>
                                    </div>
                                </div>
                                <h2 class="fw-bolder">{{ $statistics->offers }}</h2>
                                <p class="card-text">Offers</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
                @can('show_financial_statistics')
                <div class="row">
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="avatar bg-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="fa fa-bell" class="font-medium-10"></i>
                                    </div>
                                </div>
                                <span class="lead mt-2 float-right">Notification Orders</span>
                            </div>
                            <div class="row m-1">
                                <div class="col-lg-6 col-md-6">
                                    <h2 class="fw-bolder mt-1">{{$charts->notificationOrders->count}}</h2>
                                    <p class="card-text">Count</p>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <h2 class="fw-bolder mt-1">${{$charts->notificationOrders->revenue}}</h2>
                                    <p class="card-text">Revenue</p>
                                </div>
                            </div>
                            <div id="notification-orders"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="avatar bg-success p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="fa fa-window-restore" class=""></i>
                                    </div>
                                </div>
                                <span class="lead mt-2 float-right ">Banner Orders</span>
                            </div>
                            <div class="row m-1">
                                <div class="col-lg-6 col-md-6">
                                    <h2 class="fw-bolder mt-1">{{$charts->bannerOrders->count}}</h2>
                                    <p class="card-text">Count</p>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <h2 class="fw-bolder mt-1">${{$charts->bannerOrders->revenue}}</h2>
                                    <p class="card-text">Revenue</p>
                                </div>
                            </div>
                            <div id="banner-orders"></div>
                        </div>
                    </div>
                </div>
                @endcan
            </section>
        </div>

    @endsection

    @section('scriptjs')
        <script>
            var orderOptions = {
                chart: {
                    type: 'area',
                    height: 250,
                },
                series: [{
                    name: 'Reveneu',
                    data: {{json_encode($charts->notificationOrders->revenuePerMonth)}},
                }, 
                ],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
            }
            var bannerOptions = {
                chart: {
                    type: 'area',
                    height: 250,
                },
                series: [{
                    name: 'Reveneu',
                    data: {{json_encode($charts->bannerOrders->revenuePerMonth)}},
                }, 
                ],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                
            }

            var notificationChart = new ApexCharts(document.querySelector("#notification-orders"), orderOptions);
            var bannerChart = new ApexCharts(document.querySelector("#banner-orders"), bannerOptions);

            notificationChart.render();
            bannerChart.render();
        </script>
    @endsection
