@extends('layouts.app')
@section('title', 'Banner Order - ' . $banner->store?->store_name)
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
                            <div class="card-title">{{ 'Banner - ' . $banner->store?->store_name }}</div>
                        </div>
                        <div class="card-body">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <img src="{{ $banner->image ?? asset('logo.jpeg') }}" onerror="this.src='/logo.jpeg' " 
                                    class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar"
                                    style="height:250px;object-fit:cover">
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-9 col-md-6 col-lg-6 mb-2">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Order Serial</td>
                                            <td>{{ $banner->order_serial ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Merchant Name</td>
                                            <td>{{ $banner->merchant?->customer?->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Store Name</td>
                                            <td>{{ $banner->store?->store_name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">From Date</td>
                                            <td>
                                                {{ $banner->from_date }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">To Date</td>
                                            <td>{{ $banner->to_date }}</td>
                                        </tr>


                                    </table>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6 mb-2">
                                    <table class="ml-0 ml-sm-0 ml-lg-0">
                                        <tr>
                                            <td class="font-weight-bold">status</td>
                                            <td>
                                                @if ($banner->status_id == 1)
                                                    <span
                                                        class="badge badge-info">{{ $banner->status->status_name_en }}</span>
                                                @elseif($banner->status_id == 2)
                                                    <span
                                                        class="badge badge-success">{{ $banner->status->status_name_en }}</span>
                                                @elseif($banner->status_id == 3)
                                                    <span
                                                        class="badge badge-danger">{{ $banner->status->status_name_en }}</span>
                                                @endif
                                            </td>
                                        </tr>

                                        @if ($banner->status_id == 3)
                                        <tr>
                                            <td class="font-weight-bold">Reject Reason</td>
                                            <td>{{ $banner->reject_reason }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td class="font-weight-bold">Reach No</td>
                                            <td>{{ number_format($banner->reach_no)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Price</td>
                                            <td>{{ number_format($banner->price) }} USD</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Created At</td>
                                            <td>{{ $banner->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Description</td>
                                            <td>{{ $banner->description ?? '-' }}</td>
                                        </tr>

                                    </table>
                                </div>
                                    @if(!$banner->isLaunched())
                                        <button data-toggle="modal" data-target="#default" class="btn btn-outline-success"> Change Status</a>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($banner->banner_order_cities->count() != 0)
                                                @foreach ($banner->banner_order_cities as $key => $city)
                                                    <tr>
                                                        <th scope="row">{{ ++$key }}</th>
                                                        <td>{{ $city->city->name_en }}</td>
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
                <div class="col-4">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($banner->banner_order_states->count() != 0)
                                                @foreach ($banner->banner_order_states as $key => $state)
                                                    <tr>
                                                        <th scope="row">{{ ++$key }}</th>
                                                        <td>{{ $state->state->name_en }}</td>
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
                <div class="col-4">
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
                                            @if ($banner->banner_order_countries->count() != 0)
                                                @foreach ($banner->banner_order_countries as $key => $country)
                                                    <tr>
                                                        <th scope="row">{{ ++$key }}</th>
                                                        <td>{{ $country->country->country_enName }}</td>
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
                <form class="form form-vertical"
                    action="/admin-panel/banner-orders/change-status/{{ $banner->id }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" value="3" name="status_id">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">Status</label>
                                    <select name="status_id" class="form-control @error('status_id') is-invalid @enderror" onchange="changeStatus(this);">
                                        <option value="">Choose</option>
                                        @foreach (App\Models\StoreBannerOrderStatus::where('id', '!=', $banner->status_id)->get() as $status)
                                            <option value="{{ $status->id }}">{{ $status->status_name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12" style="display: none" id="rejection-reason">
                                <div class="form-group">
                                    <label for="first-name-vertical">Reason</label>
                                    <textarea name="reject_reason" id="" class="form-control @error('reject_reason') is-invalid @enderror">{{ old('reject_reason') }}</textarea>
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

<script>
    function changeStatus(status) {
        if(status.value == 3)
            $("#rejection-reason").show();
        else
            $("#rejection-reason").hide();
    };
</script>
