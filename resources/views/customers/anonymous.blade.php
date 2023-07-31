@extends('layouts.app')
@section('title', 'Anonymous')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0"> Anonymous</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Anonymous </h4>
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
                        <div class="table-responsive">
                            <table class="table" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>UUID</th>
                                        <th>Device Serial No</th>
                                        <th>Ip Address</th>
                                        <th>Created At</th>
                                        <th>Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anonymouses as $key => $anonymous)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                <div class="avatar mr-1 avatar-xl">
                                                    <img src="{{ asset($anonymous->profile_pic) }}" alt="avtar img holder">
                                                </div>
                                            </td>
                                            <td>{{ $anonymous->c_uuid }}</td>
                                            <td>{{ $anonymous->serial_no }}</td>
                                            <td>{{ $anonymous->ip_address }}</td>
                                            <td>{{ $anonymous->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <a class="btn btn-info" name="edit_button"
                                                    href="/admin-panel/customers/{{ $anonymous->id }}"><i
                                                        class="fa fa-info"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{$anonymouses->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
