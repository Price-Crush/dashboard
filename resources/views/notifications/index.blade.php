@extends('layouts.app')
@section('title', 'Notifications')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0"> Notifications</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Notifications </h4>
                    {{-- <a href="" class="btn btn-primary" data-toggle="modal" data-target="#default">Add </a> --}}
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
                        <form action="/admin-panel/notifications/" method="get">
                            <div class="row">
                                <div class="col-lg-110 col-md-10">
                                    <input type="text" name="search_item" class="form-control" value="{{request()->search_item}}" placeholder="Type store name, merchent name or title">
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
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Age Range</th>
                                        <th>Gender</th>
                                        <th>Reach No</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $key => $notification)
                                        <tr>
                                            <td>{{ $notification->id }}</td>
                                            <td>{{ $notification->merchant?->customer?->name }}</td>
                                            <td>{{ $notification->store?->store_name }}</td>
                                            <td>{{ $notification->launch_date }}</td>
                                            <td>{{ $notification->category->name_en }}</td>
                                            <td>{{ $notification->notification_title_en }}</td>
                                            <td>{{ $notification->age_range }}</td>
                                            <td>{{ $notification->gender }}</td>
                                            <td>{{ $notification->reach_no }}</td>
                                            <td>{{ $notification->status->name_en }}</td>
                                            <td>
                                                <button class="btn btn-info" name="edit_button"
                                                    value="{{ $notification->id }}" data-toggle="modal"
                                                    onclick="get_details(this)" data-target="#edit_modal"><i
                                                        class="fa fa-info"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{$notifications->appends(request()->all())->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Add </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical" action="/admin-panel/states" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $promotion_level }}" name="promotion_level">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Areas</label>
                                        <select name="areas[]" id="" class="form-control select2" multiple>
                                            <option value="">Choose</option>
                                            @if ($promotion_level == 'city')
                                                @foreach ($areas as $area)
                                                    <option value="{{ $area->id }}">{{ $area->cities->name_en }}</option>
                                                @endforeach
                                            @elseif($promotion_level == 'state')
                                                @foreach ($areas as $area)
                                                    <option value="{{ $area->id }}">{{ $area->state->name_en }}</option>
                                                @endforeach
                                            @elseif($promotion_level == 'country')
                                                @foreach ($areas as $area)
                                                    <option value="{{ $area->id }}">{{ $area->country->country_enName }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Users</label>
                                        <select name="is_anonymous" id="" class="form-control">
                                            <option value="all">all</option>
                                            <option value="0">Registred</option>
                                            <option value="1">Not Registred</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit Modal -->
    <div class="modal fade text-left" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Edit </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-section">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

            $.get("/admin-panel/notifications/" + edit_val + "/edit", function(data, status) {
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
