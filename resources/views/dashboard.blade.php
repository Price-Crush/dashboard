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
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
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
        </div>
    </div>
    <div class="content-body">
        
        <div class="content-body">
            <!-- Statistics card section -->
            <section id="statistics-card">
                <!-- Stats Vertical Card -->
                <div class="row">
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-success p-50 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-cube"></i>
                                    </div>
                                </div>
                                <h2 class="fw-bolder">{{auth()->user()->getStores()->count()}}</h2>
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
                                <h2 class="fw-bolder">{{auth()->user()->getMerchants()->count()}}</h2>
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
                                <h2 class="fw-bolder">{{auth()->user()->getCustomers()->count()}}</h2>
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
                                <h2 class="fw-bolder">{{auth()->user()->getNotificationOrders()->count()}}</h2>
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
                                <h2 class="fw-bolder">{{auth()->user()->getStoreBannerOrderOrders()->count()}}</h2>
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
                                <h2 class="fw-bolder">{{auth()->user()->getMerchantOffers()->count()}}</h2>
                                <p class="card-text">Offers</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Stats Vertical Card -->

            </section>
            <!--/ Statistics Card section-->


    </div>
@endsection
