@extends('layouts.app')
@section('title', 'Role Permissions')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Edit Role</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Role Information </h4>
                </div>
                <div class="card-content">
                    <form class="form form-vertical" action="/admin-panel/roles/{{ $role->id }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" value="{{ $role->id }}" name="id">
                        <div class="form-body">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name AR</label>
                                        <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                                            name="name_ar" placeholder="Name AR" value="{{ old('name_ar',$role->name_ar) }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name EN</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name_en" placeholder="Name EN" value="{{ old('name',$role->name_en) }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name TR</label>
                                        <input type="text" class="form-control @error('name_tr') is-invalid @enderror"
                                            name="name_tr" placeholder="Name TR" value="{{ old('name_tr',$role->name_tr) }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1 float-left">Edit</button>
                                    {{-- <button class="btn btn-danger mr-1 mb-1 float-right" onclick="if(confirm('Are You Sure ? ')){document.getElementById('delete-users_{{ $role->id }}').submit();}else{
                                        event.preventDefault();}">Delete</button>
                                        <form id="delete-users_{{ $role->id }}" action="/admin-panel/roles/{{ $role->id }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permissions </h4>
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
                        <div class="table-responsive">
                            <table class="table" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name AR</th>
                                        <th>Name EN</th>
                                        <th>Name TR</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $key => $permission)
                                        <tr>
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name_ar }}</td>
                                            <td>{{ $permission->name_en }}</td>
                                            <td>{{ $permission->name_tr }}</td>
                                            <td>
                                                <button class="btn btn-success" name="edit_button"
                                                    value="{{ $permission->id }}" data-toggle="modal" onclick="get_details(this)"
                                                    data-target="#edit_modal"><i class="fa fa-edit"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{$permissions->links()}}
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
                 <h4 class="modal-title" id="myModalLabel1">Add Permission l </h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form class="form form-vertical" action="/admin-panel/roles/assign-permission" method="POST">
                     @csrf
                     <div class="form-body">
                         <div class="row">
                             <div class="col-12">
                                 <div class="form-group">
                                     <label for="first-name-vertical">Permission</label>
                                     <select class="select2 form-control @error('name') is-invalid @enderror"
                                        name="name" id="name">
                                        <option value="">Choose</option>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}"@selected(old('name') == $permission->id)>
                                                {{ $permission->name }}
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

@endsection
