@extends('layouts.app')
@section('title', 'States')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0"> States</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">States </h4>
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#default">Add </a>
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
                        <form action="/admin-panel/states/" method="get">
                            <div class="row">
                                <div class="col-11">
                                    <input type="text" name="search_item" class="form-control" value="{{request()->search_item}}" placeholder="Type city name">
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
                                        <th>Country</th>
                                        <th>Name AR</th>
                                        <th>Name EN</th>
                                        <th>Name TR</th>
                                        <th>Price Per Person</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($states as $key => $state)
                                        <tr>
                                            <td>{{ $state->id }}</td>
                                            <td>{{ $state->country->country_enName }}</td>
                                            <td>{{ $state->name_ar }}</td>
                                            <td>{{ $state->name_en }}</td>
                                            <td>{{ $state->name_tr }}</td>
                                            <td>{{ $state->price }} USD</td>
                                            <td>
                                                <button class="btn btn-success" name="edit_button"
                                                    value="{{ $state->id }}" data-toggle="modal" onclick="get_details(this)"
                                                    data-target="#edit_modal"><i class="fa fa-edit"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{$states->appends(request()->all())->links()}}
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
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Country</label>
                                         <select name="country_id" class="form-control" id="">
                                            <option value="">Choose</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"@if($country->id == old('country_id')) selected @endif>{{ $country->country_enName }}</option>
                                            @endforeach
                                         </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name AR</label>
                                        <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                                            name="name_ar" placeholder="Name AR" value="{{ old('name_ar') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name EN</label>
                                        <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                                            name="name_en" placeholder="Name EN" value="{{ old('name_en') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name TR</label>
                                        <input type="text" class="form-control @error('name_tr') is-invalid @enderror"
                                            name="name_tr" placeholder="Name TR" value="{{ old('name_tr') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Price</label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                                            name="price" placeholder="Price" value="{{ old('price') }}"
                                            required>
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

                $.get("/admin-panel/states/" + edit_val + "/edit", function(data, status) {
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
