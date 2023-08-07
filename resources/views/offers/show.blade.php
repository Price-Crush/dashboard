@extends('layouts.app')
@section('title', 'Offer - ' . $merchantOffer->store->store_name)
@section('content')
    <div class="content-header row">
    </div>
    <div class="content-body">
        <!-- page users view start -->
        <section class="page-users-view">
            <div class="row">
                <!-- account start -->
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
                            <div class="card-title">{{ 'Offer - ' . $merchantOffer->store->store_name }}</div>
                        </div>
                        <div class="card-body">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <img src="{{ $merchantOffer->image ?? asset('logo.jpeg') }}" onerror="this.src='/logo.jpeg'  "
                                    class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar" style="height:250px;object-fit:cover">
                                </div>

                            <div class="row">

                                <div class="col-12 col-sm-9 col-md-6 col-lg-6 mb-2">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Store Name</td>
                                            <td>{{ $merchantOffer->store->store_name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">From Date</td>
                                            <td>
                                                {{ $merchantOffer->from_date }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">To Date</td>
                                            <td>{{ $merchantOffer->to_date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">status</td>
                                            <td>
                                                @if ($merchantOffer->status_id == 1)
                                                    <span class="badge badge-info">{{ $merchantOffer->status->name_en }}</span>
                                                @elseif($merchantOffer->status_id == 2)
                                                    <span class="badge badge-success">{{ $merchantOffer->status->name_en }}</span>
                                                @elseif($merchantOffer->status_id == 3)
                                                    <span class="badge badge-danger">{{ $merchantOffer->status->name_en }}</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="font-weight-bold">Created At</td>
                                            <td>{{ $merchantOffer->created_at->format('Y-m-d')}}</td>
                                        </tr>

                                    </table>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6 mb-2">
                                    <table class="ml-0 ml-sm-0 ml-lg-0">
                                        <div class="table-responsive">
                                            <table>
                                                @if($merchantOffer->description_en)
                                                    <tr>
                                                        <td class="font-weight-bold">English </td>
                                                        <td> {{ $merchantOffer->description_en }} </td>
                                                    </tr>
                                                @endif
                                                @if($merchantOffer->description_tr)
                                                    <tr>
                                                        <td class="font-weight-bold">Turkey </td>
                                                        <td> {{ $merchantOffer->description_tr }} </td>
                                                    </tr>
                                                @endif
                                                @if($merchantOffer->description_ar)
                                                    <tr>
                                                        <td class="font-weight-bold">Arabic </td>
                                                        <td> {{ $merchantOffer->description_ar }} </td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </table>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#default">
                                        Change Status</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page users view end -->

    </div>
    <!-- Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical" action="/admin-panel/offers/status/{{ $merchantOffer->id }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Status</label>
                                        <select name="status_id"
                                            class="form-control @error('status_id') is-invalid @enderror" id="">
                                            <option value="">Choose</option>
                                            @foreach ($statuses->where('id', '!=', $merchantOffer->status_id) as $status)
                                                <option value="{{ $status->id }}">{{ $status->name_en }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
