@extends('layouts.app')
@section('title', 'Stores')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0"> Stores</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Stores </h4>
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
                        <form action="/admin-panel/stores/" method="get">
                            <div class="row">
                                <div class="col-11">
                                    <input type="text" name="search_item" class="form-control" value="{{request()->search_item}}" placeholder="Type store name, merchent name, business phone or email">
                                </div>
                                <div class="col-1">
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
                                        <th></th>
                                        <th>Store Name</th>
                                        <th>Merchant Name</th>
                                        <th>Category</th>
                                        <th>Business Phone</th>
                                        <th>Business Email</th>
                                        <th>General Discount</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>status</th>
                                        <th>created At</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($stores as $key => $store)
                                   
                                        <tr>
                                            <td>{{ $store->id }}</td>
                                            <td>
                                                <div class="avatar mr-1 avatar-xl">
                                                    <img src="{{ $store->profile_pic ?? asset('logo.jpeg') }}" onerror="this.src='/logo.jpeg' "  alt="avtar img holder">
                                                </div>
                                            </td>
                                            <td>{{ $store->store_name }}</td>
                                            <td>
                                                <a href="/admin-panel/merchants/{{ $store->merchant_id }}">{{ $store->merchant->customer?->name }}</a>
                                            </td>
                                            <td>{{ $store->category->name_en }}</td>
                                            <td>{{ $store->business_phone }}</td>
                                            <td>{{ $store->business_email }}</td>
                                            <td>% {{ $store->general_discount }}</td>
                                            <td>{{ $store->country->country_enName ?? '-' }}</td>
                                            <td>{{ $store->state->name_en ?? '-' }}</td>
                                            <td>{{ $store->city->name_en ?? '-' }}</td>
                                            <td>
                                                @if ($store->status_id == 1)
                                                    <span
                                                        class="badge badge-info">{{ $store->store_status->status_name_en }}</span>
                                                @elseif($store->status_id == 2)
                                                    <span class="badge badge-success">{{ $store->store_status->status_name_en }}</span>
                                                @elseif($store->status_id == 3)
                                                    <span class="badge badge-danger">{{ $store->store_status->status_name_en }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $store->created_at->format('Y-m-d') }}</td>

                                            <td>
                                                <a class="btn btn-info" name="edit_button"
                                                    href="/admin-panel/stores/{{ $store->id }}"><i
                                                        class="fa fa-info"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{ $stores->appends(request()->all())->links() }}
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
