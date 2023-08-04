@extends('layouts.app')
@section('title', 'Merchants')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0"> Merchants</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Merchants </h4>
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
                        <form action="/admin-panel/merchants/" method="get">
                            <div class="row">
                                <div class="col-11">
                                    <input type="text" name="search_item" class="form-control" value="{{request()->search_item}}" placeholder="Type name, phone or email">
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>DOB</th>
                                        <th>National ID</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Notifications Balance</th>
                                        <th>wallet</th>
                                        <th>Account status</th>
                                        <th>Activation Date</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($merchants as $key => $merchant)
                                        <tr>
                                            <td>{{ $merchant->id }}</td>
                                            <td>
                                                <div class="avatar mr-1 avatar-xl">
                                                    <img src="{{ asset($merchant->profile_pic) }}" alt="avtar img holder">
                                                </div>
                                            </td>
                                            <td>{{ $merchant->customer?->name }}</td>
                                            <td>{{ $merchant->customer?->email }}</td>
                                            <td>{{ $merchant->customer?->phone }}</td>
                                            <td>{{ $merchant->customer?->dob }}</td>
                                            <td>{{ $merchant->national_id }}</td>
                                            <td>{{ $merchant->country->country_enName ?? '-' }}</td>
                                            <td>{{ $merchant->state->name_en ?? '-' }}</td>
                                            <td>{{ $merchant->city->name_en ?? '-' }}</td>
                                            <td>{{ $merchant->notifications_balance ?? '-' }}</td>
                                            <td>{{ $merchant->wallet }} USD</td>
                                            <td>
                                                @if ($merchant->is_active == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Not Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($merchant->is_active == 1)
                                                    {{ \Carbon\Carbon::parse($merchant->active_date)->format('Y-m-d') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-info" name="edit_button"
                                                    href="/admin-panel/merchants/{{ $merchant->id }}"><i
                                                        class="fa fa-info"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{$merchants->appends(request()->all())->links()}}
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
