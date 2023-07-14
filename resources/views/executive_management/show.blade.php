@extends('layouts.app')
@section('title', 'Executive management - ' . $user->name)
@section('content')
    <div class="content-body">
        <!-- page users view start -->
        <section class="page-users-view">
            <div class="row">
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
                            <div class="card-title">Executive management - {{ $user->name }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="users-view-image">
                                    <img src="{{ asset($user->profile_pic) }}"
                                        class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                </div>
                                <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Name</td>
                                            <td>{{ $user->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Email</td>
                                            <td>{{ $user->email ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Phone</td>
                                            <td>{{ $user->phone ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Account Status</td>
                                            <td>
                                                @if ($user->is_active == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Not Active</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-md-12 col-lg-5">
                                    <table class="ml-0 ml-sm-0 ml-lg-0">

                                        <tr>
                                            <td class="font-weight-bold">Promotion Level</td>
                                            <td>{{ $user->level->name_en ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Created At</td>
                                            <td>{{ $user->created_at ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-success mr-1" data-toggle="modal" data-target="#default">
                                        <i class="fa fa-edit"></i> Edit </button>
                                    {{-- @if ($user->is_active == 1)
                                    <a href="/admin-panel/users/status/{{ $user->id }}/0" class="btn btn-danger" onclick="if(!confirm('Are You Sure ? ')){event.preventDefault();}">
                                        <i class="fa fa-times-circle"></i> Block </a>
                                    @else
                                    <a href="/admin-panel/users/status/{{ $user->id }}/1" class="btn btn-success" onclick="if(!confirm('Are You Sure ? ')){event.preventDefault();}">
                                        <i class="fa fa-check-circle"></i> Active </a>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($user->promotion_level_id == 1)
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cities</h4>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCity">
                                    Add
                                </button>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>City Name</th>
                                                    <th>delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($user->executive_cities->count() != 0)
                                                    @foreach ($user->executive_cities as $key => $city)
                                                        <tr>
                                                            <th scope="row">{{ ++$key }}</th>
                                                            <td>{{ $city->cities->name_en }}</td>
                                                            <td>
                                                                <button class="btn btn-danger"
                                                                    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $city->id }}').submit();}else{
                                                                    event.preventDefault();}">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                                <form id="delete-users_{{ $city->id }}"
                                                                    action="/admin-panel/executive_management/delete_city/{{ $city->id }}"
                                                                    method="POST" class="d-none">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
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
                @elseif($user->promotion_level_id == 2)
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">States</h4>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addState">
                                    Add
                                </button>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>State Name</th>
                                                    <th>delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($user->executive_states->count() != 0)
                                                    @foreach ($user->executive_states as $key => $state)
                                                        <tr>
                                                            <th scope="row">{{ ++$key }}</th>
                                                            <td>{{ $state->state->name_en }}</td>
                                                            <td>
                                                                <button class="btn btn-danger"
                                                                    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $state->id }}').submit();}else{
                                                                    event.preventDefault();}">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                                <form id="delete-users_{{ $state->id }}"
                                                                    action="/admin-panel/executive_management/delete_state/{{ $state->id }}"
                                                                    method="POST" class="d-none">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
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
                @elseif($user->promotion_level_id == 3)
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Countries</h4>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addCountry">
                                    Add
                                </button>
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
                                                @if ($user->executive_countries->count() != 0)
                                                    @foreach ($user->executive_countries as $key => $country)
                                                        <tr>
                                                            <th scope="row">{{ ++$key }}</th>
                                                            <td>{{ $country->country->country_enName }}</td>
                                                            <td>
                                                                <button class="btn btn-danger"
                                                                    onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $country->id }}').submit();}else{
                                                                    event.preventDefault();}">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                                <form id="delete-users_{{ $country->id }}"
                                                                    action="/admin-panel/executive_management/delete_country/{{ $country->id }}"
                                                                    method="POST" class="d-none">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
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
                @endif
            </div>
        </section>
        <!-- page users view end -->

    </div>
    <!-- Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
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
                    <form class="form form-vertical" action="/admin-panel/executive_management/{{ $user->id }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="Name" value="{{ old('name', $user->name) }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" placeholder="Email" value="{{ old('email', $user->email) }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Phone</label>
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" placeholder="Phone" value="{{ old('phone', $user->phone) }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="Password" value="{{ old('password') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Image</label>
                                        <input type="file"
                                            class="form-control @error('profile_pic') is-invalid @enderror"
                                            name="profile_pic">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Promotion Level</label>
                                        <select name="promotion_level_id" class="form-control" required>
                                            <option value="">Choose</option>
                                            @foreach ($levels as $level)
                                                <option value="{{ $level->id }}" @selected(old('promotion_level_id', $user->promotion_level_id) == $level->id)>
                                                    {{ $level->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Account Status</label>
                                        <select name="is_active" class="form-control" required>
                                            <option value="">Choose</option>
                                            <option value="1" @selected(old('is_active', $user->is_active) == 1)>Active</option>
                                            <option value="0" @selected(old('is_active', $user->is_active) == 0)>Not Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success mr-1 mb-1">Update</button>
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
    <!-- Modal -->
    <div class="modal fade" id="addCity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">add City</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical" action="/admin-panel/executive_management/store_city"
                        method="POST">
                        @csrf
                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Cities</label>
                                        <select name="city_id[]" class="form-control select2" required
                                            multiple="multiple">
                                            <option value="">Choose</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" @selected(old('city_id') == $city->id)>
                                                    {{ $city->name_en }}</option>
                                            @endforeach
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addState" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add State</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical" action="/admin-panel/executive_management/store_state"
                        method="POST">
                        @csrf
                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Cities</label>
                                        <select name="state_id[]" class="form-control select2" required
                                            multiple="multiple">
                                            <option value="">states</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}" @selected(old('state_id') == $state->id)>
                                                    {{ $state->name_en }}</option>
                                            @endforeach
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addCountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical" action="/admin-panel/executive_management/store_country"
                    method="POST">
                    @csrf
                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">Cities</label>
                                    <select name="country_id[]" class="form-control select2" required
                                        multiple="multiple">
                                        <option value="">states</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>
                                                {{ $country->country_enName }}</option>
                                        @endforeach
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
