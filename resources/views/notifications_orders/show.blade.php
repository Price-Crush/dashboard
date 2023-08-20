@extends('layouts.app')
@section('title', 'Notification Order - ' . $merchantNotificationOrder->store?->store_name)
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
                            <div class="card-title">
                                {{ 'Order Notification - ' . $merchantNotificationOrder->store?->store_name }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-9 col-md-6 col-lg-6 mb-2">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Merchant Name</td>
                                            <td>{{ $merchantNotificationOrder->merchant?->customer?->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Store Name</td>
                                            <td>{{ $merchantNotificationOrder->store?->store_name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Launch Date</td>
                                            <td>
                                                {{ $merchantNotificationOrder->launch_date }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Age Range</td>
                                            <td>{{ $merchantNotificationOrder->age_range }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Gender</td>
                                            <td>{{ $merchantNotificationOrder->gender }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Category</td>
                                            <td>{{ $merchantNotificationOrder->category->name_en }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6 mb-2">
                                    <table class="ml-0 ml-sm-0 ml-lg-0">
                                        <tr>
                                            <td class="font-weight-bold">status</td>
                                            <td>
                                                @if ($merchantNotificationOrder->status_id == 1)
                                                    <span
                                                        class="badge badge-info">{{ $merchantNotificationOrder->status->status_name_en }}</span>
                                                @elseif($merchantNotificationOrder->status_id == 2)
                                                    <span
                                                        class="badge badge-success">{{ $merchantNotificationOrder->status->status_name_en }}</span>
                                                @elseif($merchantNotificationOrder->status_id == 3)
                                                    <span
                                                        class="badge badge-danger">{{ $merchantNotificationOrder->status->status_name_en }}</span>
                                                @endif
                                            </td>
                                        </tr>

                                        @if ($merchantNotificationOrder->status_id == 3)
                                            <tr>
                                                <td class="font-weight-bold">Reject Reason</td>
                                                <td>{{ $merchantNotificationOrder->reject_reason }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="font-weight-bold">Reach No</td>
                                            <td>{{ number_format($merchantNotificationOrder->reach_no) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Price</td>
                                            <td>{{ number_format($merchantNotificationOrder->price) }} USD</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Created At</td>
                                            <td>{{ $merchantNotificationOrder->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Description</td>
                                            <td>{{ $merchantNotificationOrder->description ?? '-' }}</td>
                                        </tr>

                                    </table>
                                </div>
                                <div class="col-12">
                                    
                                        {{-- <a href="/admin-panel/notification-orders/approve/{{ $merchantNotificationOrder->id }}/2"
                                            onclick="if(!confirm('Are You Sure ? ')){event.preventDefault();}"
                                            class="btn btn-outline-success mr-1"><i class="fa fa-check-circle"></i>
                                            Approve</a> --}}
                                        @if(!$merchantNotificationOrder->isLaunched())
                                        <button data-toggle="modal" data-target="#default" class="btn btn-outline-success"> Change Status</a>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Notification Description</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table>
                                        @if($merchantNotificationOrder->notification_title_en)
                                            <tr>
                                                <td class="font-weight-bold">English </td>
                                                <td> {{ $merchantNotificationOrder->notification_title_en }} </td>
                                            </tr>
                                        @endif
                                        @if($merchantNotificationOrder->notification_title_tr)
                                            <tr>
                                                <td class="font-weight-bold">Turkey </td>
                                                <td> {{ $merchantNotificationOrder->notification_title_tr }} </td>
                                            </tr>
                                        @endif
                                        @if($merchantNotificationOrder->notification_title_ar)
                                            <tr>
                                                <td class="font-weight-bold">Arabic </td>
                                                <td> {{ $merchantNotificationOrder->notification_title_ar }} </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="row">
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
                                            @if ($merchantNotificationOrder->notification_order_cities->count() != 0)
                                                @foreach ($merchantNotificationOrder->notification_order_cities as $key => $city)
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
                                            @if ($merchantNotificationOrder->notification_order_states->count() != 0)
                                                @foreach ($merchantNotificationOrder->notification_order_states as $key => $state)
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
                                            @if ($merchantNotificationOrder->notification_order_countries->count() != 0)
                                                @foreach ($merchantNotificationOrder->notification_order_countries as $key => $country)
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
                        action="/admin-panel/notification-orders/change-status/{{ $merchantNotificationOrder->id }}" method="POST">
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
                                            @foreach (App\Models\MerchantNotificationOrderStatus::where('id', '!=', $merchantNotificationOrder->status_id)->get() as $status)
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