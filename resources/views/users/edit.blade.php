@extends('layouts.app')
@section('title', 'User Update')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Edit User</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Information </h4>
                </div>
                <div class="card-content">
                    <form class="form" action="/admin-panel/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" value="{{ $user->id }}" name="id">
                        <div class="form-body">
                            <div class="row" style="padding: 10px">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="Name" value="{{ old('name',$user->name) }}" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" placeholder="Email" value="{{ old('email',$user->email) }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Phone</label>
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" placeholder="Phone" value="{{ old('phone',$user->phone) }}" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="Password" value="{{ old('password') }}"
                                            >
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
                                        <label for="email-id-vertical">Account Status</label>
                                        <select name="is_active" class="form-control" required>
                                            <option value="">Choose</option>
                                            <option value="1" @selected(old('is_active',$user->is_active) == 1)>Active</option>
                                            <option value="0" @selected(old('is_active',$user->is_active) == 0)>Not Active</option>
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
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Role </h4>
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
                        <form class="form form-vertical" action="/admin-panel/users/{{$user->id}}/update-role" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Roles</label>
                                            <select class="select2 form-control @error('role') is-invalid @enderror"
                                               name="role" id="role" required>
                                               <option value="">Choose</option>
                                               @foreach ($roles as $role)
                                                   <option value="{{ $role->name }}"@selected($user->roles->first()?->name == $role->name)>
                                                       {{ $role->name_en }}
                                                   </option>
                                               @endforeach
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Change</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Special Permissions </h4>
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#add-permission">Add </a>
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
                            <table class="table" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name AR</th>
                                        <th>Name EN</th>
                                        <th>Name TR</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->permissions as $key => $permission)
                                        <tr>
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name_ar }}</td>
                                            <td>{{ $permission->name_en }}</td>
                                            <td>{{ $permission->name_tr }}</td>
                                            <td>
                                                <button class="btn btn-danger mr-2"
                                                    onclick="if(confirm('Are You Sure ? ')){document.getElementById('revoke-permission_{{ $permission->id }}').submit();}else{
                                                    event.preventDefault();}">Remove</button>
                                                    <form id="revoke-permission_{{ $permission->id }}" action="/admin-panel/users/{{ $user->id }}/revoke-permission" method="POST" class="d-none">
                                                        @csrf
                                                        <input type="hidden" name="permission" value="{{$permission->name}}">
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{-- {{$role->permissions->links()}} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Areas Management</h4>
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#add-area">Add </a>
                </div>

                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="row">
                        {{-- @if ($user->promotion_level_id == 1) --}}
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Cities</h4>
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
                                                                        onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-city_{{ $city->id }}').submit();}else{
                                                                        event.preventDefault();}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                    <form id="delete-city_{{ $city->id }}"
                                                                        action="/admin-panel/users/{{$user->id}}/remove-area"
                                                                        method="POST" class="d-none">
                                                                        @csrf
                                                                        <input type="hidden" name="city_id" value="{{ $city->id }}">
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
                    {{-- @elseif($user->promotion_level_id == 2) --}}
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">States</h4>
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
                                                                        onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-state_{{ $state->id }}').submit();}else{
                                                                        event.preventDefault();}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                    <form id="delete-state_{{ $state->id }}"
                                                                        action="/admin-panel/users/{{$user->id}}/remove-area"
                                                                        method="POST" class="d-none">
                                                                        @csrf
                                                                        <input type="hidden" name="state_id" value="{{ $state->id }}">
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
                    {{-- @elseif($user->promotion_level_id == 3) --}}
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Countries</h4>
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
                                                                        onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-country_{{ $country->id }}').submit();}else{
                                                                        event.preventDefault();}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                    <form id="delete-country_{{ $country->id }}"
                                                                        action="/admin-panel/users/{{$user->id}}/remove-area"
                                                                        method="POST" class="d-none">
                                                                        @csrf
                                                                        <input type="hidden" name="country_id" value="{{ $country->id }}">
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
                    {{-- @endif --}}
                    </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Add Permission Modal -->
    <div class="modal fade text-left" id="add-permission" tabindex="-1" role="dialog" aria-labelledby="add-permission" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="add-permission">Add Permission </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical" action="/admin-panel/users/{{$user->id}}/give-permission" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Permission</label>
                                        <select class="select2 form-control @error('permission') is-invalid @enderror"
                                            name="permission" id="permission">
                                            <option value="">Choose</option>
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->name }}"@selected(old('permission') == $permission->name)>
                                                    {{ $permission->name_en }}
                                                </option>
                                            @endforeach
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
    <!-- End Add Permission Modal !-->

    <!-- Add Area Modal -->
    <div class="modal fade text-left" id="add-area" tabindex="-1" role="dialog" aria-labelledby="add-area" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="add-area">Add Area </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical" action="/admin-panel/users/{{$user->id}}/add-area" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Countries</label>
                                        <select class="select2 form-control @error('country_id') is-invalid @enderror"
                                            name="country_id" id="country" required>
                                            <option value="">Choose</option>
                                            @foreach ($countries as $country)
                                                @if (Auth::user()->user_type_id == 2)
                                                    <option
                                                        value="{{ $country->country_id }}"@selected(old('country_id') == $country->id)>
                                                        {{ $country->country->country_enName }}
                                                    </option>
                                                @else
                                                    <option value="{{ $country->id }}"@selected(old('country_id') == $country->id)>
                                                        {{ $country->country_enName }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">States</label>
                                        <select class="select2 form-control @error('state_id') is-invalid @enderror"
                                            name="state_id" id="state">
                                            <option value="">Choose</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">City</label>
                                        <select class="select2 form-control @error('city_id') is-invalid @enderror"
                                            name="city_id" id="city">
                                            <option value="">Choose</option>
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
    <!-- End Add Area Modal !-->

@endsection
