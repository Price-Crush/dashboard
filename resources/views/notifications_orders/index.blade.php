@extends('layouts.app')
@section('title', 'Notification Orders')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Notification Orders</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
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
                        <form action="/admin-panel/notification-orders/" method="get">
                            <div class="row">
                                <div class="col-lg-110 col-md-10">
                                    <input type="text" name="search_item" class="form-control" value="{{request()->search_item}}" placeholder="Type store name or merchant name">
                                </div>
                                <div class="col-lg-1 col-md-2">
                                    <input type="submit" value="Search" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                        <br>
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
                                    @foreach ($notification_orders as $key => $notification_order)
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
                            <div class="justify-content-center">{{ $notification_orders->appends(request()->all())->links() }}</div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptjs')
    <script>
        function get_details(val) {
            var edit_val = val.value;

            $(".form-section").html(" ");
            $(".form-section").append(
                "<center><img src='{{ asset('loader.gif') }}'  width='300px'/></center>"
            );

            $.get("/admin-panel/countries/" + edit_val + "/edit", function(data, status) {
                $(".form-section").html(data);
            }).fail(function() {
                $(".form-section").html(" ");
                $(".form-section").append(
                    "<div class='alert alert-danger' role='alert'>Oops !! , Something Wrong</div>"
                );
            });
        };
    </script>
@endsection
