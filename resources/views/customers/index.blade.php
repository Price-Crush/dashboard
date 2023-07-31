@extends('layouts.app')
@section('title', 'Customers')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0"> Customers</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Customers</h4>
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
                            <form action="/admin-panel/customers/" method="get">
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
                            <table class="table" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>DOB</th>
                                        <th>Gender</th>
                                        <th>Business Sector</th>
                                        <th>Nationality</th>
                                        <th>Country Resident</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Last Activity</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $key => $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>
                                            <td>
                                                <div class="avatar mr-1 avatar-xl">
                                                    <img src="{{ asset($customer->profile_pic) }}" alt="avtar img holder">
                                                </div>
                                            </td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->dob }}</td>
                                            <td>{{ $customer->gender }}</td>
                                            <td>{{ $customer->business_sectors->sector_name_en }}</td>
                                            <td>{{ $customer->nationality->country_enNationality }}</td>
                                            <td>{{ $customer->c_resident_country->country_enName ?? '-' }}</td>
                                            <td>{{ $customer->state->name_en ?? '-' }}</td>
                                            <td>{{ $customer->city->name_en ?? '-' }}</td>
                                            <td>{{ $customer->last_activity ?? '-' }}</td>
                                            <td>
                                                <a class="btn btn-info" name="edit_button"
                                                    href="/admin-panel/customers/{{ $customer->id }}"><i class="fa fa-info"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{$customers->appends(request()->all())->links()}}
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
