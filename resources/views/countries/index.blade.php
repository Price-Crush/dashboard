@extends('layouts.app')
@section('title', 'Countries')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0"> Countries</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Countries </h4>
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#default">add</a>
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
                        <form action="/admin-panel/countries/" method="get">
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
                                        <th>Code</th>
                                        <th>Name EN</th>
                                        <th>Name AR</th>
                                        <th>Name TR</th>
                                        <th>Nationality EN</th>
                                        <th>Nationality AR</th>
                                        <th>Nationality TR</th>
                                        <th>Price Per Person</th>
                                        <th>User Banner Price</th>
                                        <th>Users Average</th>
                                        <th>Google Ads</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($countries as $key => $country)
                                        <tr>
                                            <td>{{ $country->id }}</td>
                                            <td>{{ $country->country_code }}</td>
                                            <td>{{ $country->country_enName }}</td>
                                            <td>{{ $country->country_arName }}</td>
                                            <td>{{ $country->country_trName ?? '-' }}</td>
                                            <td>{{ $country->country_enNationality }}</td>
                                            <td>{{ $country->country_arNationality }}</td>
                                            <td>{{ $country->country_trNationality ?? '-' }}</td>
                                            <td>{{ $country->price }}</td>
                                            <td>{{ $country->user_banner_price }}</td>
                                            <td>{{ $country->users_average }}</td>
                                            <td>
                                                @if($country->google_ads == 0)
                                                Off
                                                @else
                                                On
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-success" name="edit_button"
                                                    value="{{ $country->id }}" data-toggle="modal" onclick="get_details(this)"
                                                    data-target="#edit_modal"><i class="fa fa-edit"></i></button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{ $countries->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Add </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical" action="/admin-panel/countries" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Country Code</label>
                                        <input type="text" class="form-control @error('country_code') is-invalid @enderror"
                                            name="country_code" placeholder="Country Code" value="{{ old('country_code') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name EN</label>
                                        <input type="text" class="form-control @error('country_enName') is-invalid @enderror"
                                            name="country_enName" placeholder="Name EN" value="{{ old('country_enName') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name AR</label>
                                        <input type="text" class="form-control @error('country_arName') is-invalid @enderror"
                                            name="country_arName" placeholder="Name AR" value="{{ old('country_arName') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name TR</label>
                                        <input type="text" class="form-control @error('country_trName') is-invalid @enderror"
                                            name="country_trName" placeholder="Name TR" value="{{ old('country_trName') }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nationality EN</label>
                                        <input type="text" class="form-control @error('country_enNationality') is-invalid @enderror"
                                            name="country_enNationality" placeholder="Nationality EN" value="{{ old('country_enNationality') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nationality AR</label>
                                        <input type="text" class="form-control @error('country_arNationality') is-invalid @enderror"
                                            name="country_arNationality" placeholder="Nationality AR" value="{{ old('country_arNationality') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nationality TR</label>
                                        <input type="text" class="form-control @error('country_trNationality') is-invalid @enderror"
                                            name="country_trNationality" placeholder="Nationality TR" value="{{ old('country_trNationality') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Price</label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                                            name="price" placeholder="Price" value="{{ old('price') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">User Banner Price</label>
                                        <input type="text" class="form-control @error('user_banner_price') is-invalid @enderror"
                                            name="user_banner_price" placeholder="User Banner Price" value="{{ old('user_banner_price') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Users Average</label>
                                        <input type="text" class="form-control @error('users_average') is-invalid @enderror"
                                            name="users_average" placeholder="Users Average" value="{{ old('users_average') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Google Ads</label>
                                        <select name="google_ads" class="form-control @error('google_ads') is-invalid @enderror" required>
                                            <option value="">Choose</option>
                                            <option value="1" @selected(old('google_ads') == 1)>On</option>
                                            <option value="0" @selected(old('google_ads') == 0)>Off</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit Modal -->
    <div class="modal fade text-left" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
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
