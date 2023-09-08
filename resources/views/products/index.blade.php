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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>DOB</th>
                                        <th>National ID</th>
                                        <th>Account status</th>
                                        <th>Activation Date</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($merchants as $key => $merchant)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                <div class="avatar mr-1 avatar-xl">
                                                    <img src="{{ $merchant->profile_pic ?? asset('logo.jpeg') }}" onerror="this.src='/logo.jpeg' " alt="avtar img holder">
                                                </div>
                                            </td>
                                            <td>{{ $merchant->name }}</td>
                                            <td>{{ $merchant->email }}</td>
                                            <td>{{ $merchant->phone_number }}</td>
                                            <td>{{ $merchant->dob }}</td>
                                            <td>{{ $merchant->national_id }}</td>
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
                            {{ $merchants->links('pagination::bootstrap-4') }}
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
