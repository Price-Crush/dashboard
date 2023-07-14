@extends('layouts.app')
@section('title', 'Banner Orders')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Banner Orders</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Banner Orders</h4>
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
                        <div class="table-responsive">
                            <table class="table zero-configuration">
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
                                    @foreach ($banners as $key => $banner)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                <div class="avatar mr-1 avatar-xl">
                                                    <img src="{{ asset($banner->image) }}" alt="avtar img holder">
                                                </div>
                                            </td>
                                            <td>{{ $banner->merchant->name }}</td>
                                            <td>{{ $banner->store->store_name }}</td>
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
