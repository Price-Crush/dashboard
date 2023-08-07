@extends('layouts.app')
@section('title', $merchantStore->store_name)
@section('content')
    <div class="content-body">
        <!-- page users view start -->
        <section class="page-users-view">
            <div class="row">
                <!-- account start -->
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Store</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="users-view-image">
                                    <img src="{{ $merchantStore->profile_pic ?? asset('logo.jpeg') }}" onerror="this.src='/logo.jpeg' " 
                                        class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                </div>
                                <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Store Name</td>
                                            <td>{{ $merchantStore->store_name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Merchant Name</td>
                                            <td>
                                                <a
                                                    href="/admin-panel/merchants/{{ $merchantStore->merchant_id }}">{{ $merchantStore->merchant?->customer?->name ?? '-' }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Email</td>
                                            <td>{{ $merchantStore->business_email ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Phone</td>
                                            <td>{{ $merchantStore->phone ?? '-' }}</td>
                                        </tr>

                                    </table>
                                </div>
                                <div class="col-12 col-md-12 col-lg-5">
                                    <table class="ml-0 ml-sm-0 ml-lg-0">
                                        <tr>
                                            <td class="font-weight-bold">Business Phone</td>
                                            <td>{{ $merchantStore->business_phone ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Whatsapp Phone</td>
                                            <td>{{ $merchantStore->whatsapp_phone ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Status</td>
                                            <td>
                                                @if ($merchantStore->status_id == 1)
                                                    <span
                                                        class="badge badge-info">{{ $merchantStore->store_status->status_name_en }}</span>
                                                @elseif($merchantStore->status_id == 2)
                                                    <span
                                                        class="badge badge-success">{{ $merchantStore->store_status->status_name_en }}</span>
                                                @elseif($merchantStore->status_id == 3)
                                                    <span
                                                        class="badge badge-danger">{{ $merchantStore->store_status->status_name_en }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Created At</td>
                                            <td>{{ $merchantStore->created_at ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#default">
                                        Change Status</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- account end -->
                <div class="col-md-6 col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-2">Other Information</div>
                        </div>
                        <div class="card-body">
                            <div class="col-12 col-md-12 col-lg-12">
                                <table class="ml-0 ml-sm-0 ml-lg-0">
                                    <tr>
                                        <td class="font-weight-bold">General Discount</td>
                                        <td>% {{ $merchantStore->general_discount }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Business License</td>
                                        <td>{{ $merchantStore->business_license }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Category</td>
                                        <td>{{ $merchantStore->category->name_en }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Primary Language</td>
                                        <td>
                                            {{ $merchantStore->primary_language?->language_name_en }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Secondry Language</td>
                                        <td>
                                            {{ $merchantStore->secondry_language?->language_name_en }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Appearance Level</td>
                                        <td>
                                            {{ $merchantStore->appearance_level?->name_en }}
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- social links end -->
                <!-- social links end -->
                <div class="col-md-6 col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-2">Social Links</div>
                        </div>
                        <div class="card-body">
                            <table>

                                <tr>
                                    <td class="font-weight-bold">Facebook</td>
                                    <td>
                                        <a href="{{ $merchantStore->facebook }}">{{ $merchantStore->facebook }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Instagram</td>
                                    <td> <a href="{{ $merchantStore->instagram }}">{{ $merchantStore->instagram }}</a>

                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <!-- social links end -->
                <div class="col-md-6 col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-2">About Store</div>
                        </div>
                        <div class="card-body">
                            {{ $merchantStore->about_store }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-2">Store Description</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    @if($merchantStore->store_description_en)
                                        <tr>
                                            <td class="font-weight-bold">English </td>
                                            <td> {{ $merchantStore->store_description_en }} </td>
                                        </tr>
                                    @endif
                                    @if($merchantStore->store_description_tr)
                                        <tr>
                                            <td class="font-weight-bold">Turkey </td>
                                            <td> {{ $merchantStore->store_description_tr }} </td>
                                        </tr>
                                    @endif
                                    @if($merchantStore->store_description_ar)
                                        <tr>
                                            <td class="font-weight-bold">Arabic </td>
                                            <td> {{ $merchantStore->store_description_ar }} </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Products</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th>Product Name</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($merchantStore->products->count() != 0)
                                                @foreach ($merchantStore->products as $key => $product)
                                                    <tr>
                                                        <th scope="row">{{ ++$key }}</th>
                                                        <td>
                                                            <div class="avatar mr-1 avatar-xl">
                                                                <img src="{{ $product->image ?? asset('logo.jpeg') }}" onerror="this.src='/logo.jpeg' "
                                                                    alt="avtar img holder" style="object-fit: cover">
                                                            </div>
                                                        </td>
                                                        <td>{{ $product->product_name }}</td>
                                                        <td>{{ $product->description }}</td>
                                                        <td>{{ $product->price }} USD</td>
                                                        <td>
                                                            @if ($product->is_active == 1)
                                                                <span class="badge badge-success">Active</span>
                                                            @else
                                                                <span class="badge badge-danger">Not Active</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $product->created_at }}</td>
                                                        <td>
                                                            <a class="btn btn-info" name="edit_button"
                                                                href="/admin-panel/products/{{ $product->id }}"><i
                                                                    class="fa fa-info"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2"> No Data Available !!</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Favourite Cities</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>City Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($merchantStore->store_cities->count() != 0)
                                                @foreach ($merchantStore->store_cities as $key => $city)
                                                    <tr>
                                                        <th scope="row">{{ ++$key }}</th>
                                                        <td>{{ $city->cities->name_en }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2"> No Data Available !!</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Favourite States</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>State Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($merchantStore->store_states->count() != 0)
                                                @foreach ($merchantStore->store_states as $key => $state)
                                                    <tr>
                                                        <th scope="row">{{ ++$key }}</th>
                                                        <td>{{ $state->states->name_en }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2"> No Data Available !!</td>

                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Favourite Countries</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Country Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($merchantStore->store_countries->count() != 0)
                                                @foreach ($merchantStore->store_countries as $key => $country)
                                                    <tr>
                                                        <th scope="row">{{ ++$key }}</th>
                                                        <td>{{ $country->countries->country_enName }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2"> No Data Available !!</td>

                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Favourite Categories</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Category Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($merchantStore->store_categories->count() != 0)
                                                @foreach ($merchantStore->store_categories as $key => $category)
                                                    <tr>
                                                        <th scope="row">{{ ++$key }}</th>
                                                        <td>{{ $category->categories->name_en ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2"> No Data Available !!</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Rates</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer Name</th>
                                                <th>Rate</th>
                                                <th>Review</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($merchantStore->store_rates->count() != 0)
                                                @foreach ($merchantStore->store_rates as $key => $rate)
                                                    <tr>
                                                        <th scope="row">{{ ++$key }}</th>
                                                        <td>{{ $rate->customer?->name }}</td>
                                                        <td>{{ $rate->rating ?? '-' }}</td>
                                                        <td>{{ $rate->review ?? '-' }}</td>
                                                        <td>
                                                            @if ($rate->is_active == 1)
                                                                <span class="badge badge-primary">Active</span>
                                                            @elseif($rate->is_active == 0)
                                                                <span class="badge badge-danger">Not Active</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $rate->created_at ?? '-' }}</td>
                                                        <td>
                                                            @if ($rate->is_active == 1)
                                                                <a href="/admin-panel/rate/status/{{ $rate->id }}/0"
                                                                    onclick="if(!confirm('Are You Sure ? ')){event.preventDefault();}"
                                                                    class="btn btn-danger btn-sm"><i
                                                                        class="fa fa-times"></i>
                                                                    Block</a>
                                                            @elseif($rate->is_active == 0 || $rate->is_active == 2)
                                                                <a href="/admin-panel/rate/status/{{ $rate->id }}/1"
                                                                    onclick="if(!confirm('Are You Sure ? ')){event.preventDefault();}"
                                                                    class="btn btn-success btn-sm"><i
                                                                        class="fa fa-check-circle"></i>
                                                                    Active</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2"> No Data Available !!</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Notification Orders</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- <form action="/admin-panel/notification-orders/" method="get">
                            <div class="row">
                                <div class="col-lg-110 col-md-10">
                                    <input type="text" name="search_item" class="form-control" value="{{request()->search_item}}" placeholder="Type store name or merchant name">
                                </div>
                                <div class="col-lg-1 col-md-2">
                                    <input type="submit" value="Search" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                        <br> --}}
                        <div class="table-responsive">
                            <table class="table" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Merchant Name</th>
                                        <th>Store Name</th>
                                        <th>Launch Date</th>
                                        <th>Age Range</th>
                                        <th>Gender</th>
                                        <th>Category</th>
                                        <th>Reach No</th>
                                        <th>Price</th>
                                        <th>status</th>
                                        <th>created At</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($merchantStore->notificationOrders as $key => $notification_order)
                                        <tr>
                                            <td>{{ $notification_order->id  }}</td>
                                            <td>{{ $notification_order->merchant?->customer?->name }}</td>
                                            <td>{{ $notification_order->store?->store_name }}</td>
                                            <td>{{ $notification_order->launch_date }}</td>
                                            <td>{{ $notification_order->age_range }}</td>
                                            <td>{{ $notification_order->gender }}</td>
                                            <td>{{ $notification_order->category->name_en }}</td>
                                            <td>{{ $notification_order->reach_no }}</td>
                                            <td>{{ $notification_order->price }}</td>
                                            <td>
                                                @if ($notification_order->status_id == 1)
                                                    <span
                                                        class="badge badge-info">{{ $notification_order->status->status_name_en }}</span>
                                                @elseif($notification_order->status_id == 2)
                                                    <span
                                                        class="badge badge-success">{{ $notification_order->status->status_name_en }}</span>
                                                @elseif($notification_order->status_id == 3)
                                                    <span
                                                        class="badge badge-danger">{{ $notification_order->status->status_name_en }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $notification_order->created_at->format('Y-m-d') }}</td>

                                            <td>
                                                <a class="btn btn-info" name="edit_button"
                                                    href="/admin-panel/notification-orders/{{ $notification_order->id }}"><i
                                                        class="fa fa-info"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{ $merchantStore->notificationOrders->links() }}
                            <br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Banners Orders</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- <form action="/admin-panel/banner-orders/" method="get">
                            <div class="row">
                                <div class="col-lg-110 col-md-10">
                                    <input type="text" name="search_item" class="form-control" value="{{request()->search_item}}" placeholder="Type store name or merchant name">
                                </div>
                                <div class="col-lg-1 col-md-2">
                                    <input type="submit" value="Search" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                        <br> --}}
                        <div class="table-responsive">
                            <table class="table " id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Merchant Name</th>
                                        <th>Store Name</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Reach Number</th>
                                        <th>Price</th>
                                        <th>status</th>
                                        <th>created At</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($merchantStore->bannerOrders as $key => $banner)
                                        <tr>
                                            <td>{{ $banner->id }}</td>
                                            <td>
                                                <div class="avatar mr-1 avatar-xl">
                                                    <img src="{{ $banner->image ?? asset('logo.jpeg') }}" onerror="this.src='/logo.jpeg' " alt="avtar img holder">
                                                </div>
                                            </td>
                                            <td>{{ $banner->merchant?->customer?->name }}</td>
                                            <td>{{ $banner->store?->store_name }}</td>
                                            <td>{{ $banner->from_date }}</td>
                                            <td>{{ $banner->to_date }}</td>
                                            <td>{{ $banner->reach_no }}</td>
                                            <td>{{ $banner->price }}</td>
                                            <td>
                                                @if ($banner->status_id == 1)
                                                    <span
                                                        class="badge badge-info">{{ $banner->status->status_name_en }}</span>
                                                @elseif($banner->status_id == 2)
                                                    <span
                                                        class="badge badge-success">{{ $banner->status->status_name_en }}</span>
                                                @elseif($banner->status_id == 3)
                                                    <span
                                                        class="badge badge-danger">{{ $banner->status->status_name_en }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $banner->created_at->format('Y-m-d') }}</td>

                                            <td>
                                                <a class="btn btn-info" name="edit_button"
                                                    href="/admin-panel/banner-orders/{{ $banner->id }}"><i
                                                        class="fa fa-info"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{-- {{$merchantStore->bannerOrders->links()}} --}}
                         </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page users view end -->

    </div>
    <!-- Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical" action="/admin-panel/stores/status/{{ $merchantStore->id }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Status</label>
                                        <select name="status_id"
                                            class="form-control @error('status_id') is-invalid @enderror" id="">
                                            <option value="">Choose</option>
                                            @foreach ($statuses->where('id', '!=', $merchantStore->status_id) as $status)
                                                <option value="{{ $status->id }}">{{ $status->status_name_en }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
