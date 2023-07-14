@extends('layouts.app')
@section('title', $merchant->name)
@section('content')
    <div class="content-header row">
    </div>
    <div class="content-body">
        <!-- page users view start -->
        <section class="page-users-view">
            <div class="row">
                <!-- account start -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Account</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="users-view-image">
                                    <img src="{{ asset($merchant->profile_pic) }}"
                                        class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                </div>
                                <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Name</td>
                                            <td>{{ $merchant->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Email</td>
                                            <td>{{ $merchant->email ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Phone</td>
                                            <td>{{ $merchant->phone ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Last Login</td>
                                            <td>{{ \Carbon\Carbon::parse($merchant->last_login)->format('Y-m-d') ?? '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Created At</td>
                                            <td>{{ $merchant->created_at->format('Y-m-d') ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-md-12 col-lg-5">
                                    <table class="ml-0 ml-sm-0 ml-lg-0">
                                        <tr>
                                            <td class="font-weight-bold">Birth Date</td>
                                            <td>{{ \Carbon\Carbon::parse($merchant->dob)->format('Y-m-d') ?? '-' }}</td>
                                        </tr>

                                        <tr>
                                            <td class="font-weight-bold">National ID</td>
                                            <td>{{ $merchant->national_id}}</td>
                                        </tr>
                                        @if ($merchant->warning_id != null)
                                        <tr>
                                            <td class="font-weight-bold">Warning Alert</td>
                                            <td>

                                                <span class="badge" @if ($merchant->warning_id == 1) style="background-color: yellow;color:black;margin-right:3px;" @elseif($merchant->warning_id == 2)  style="background-color: #ff9f43;color:white;margin-right:3px;" @elseif($merchant->warning_id == 3)  style="background-color: red;color:white;margin-right:3px;" @endif>
                                                <i class="fa fa-exclamation-triangle"></i>
                                                </span>
                                                 {{ $merchant->m_warning_alerts->card_name_en ?? '-' }}
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td class="font-weight-bold">Account Status</td>
                                            <td>
                                                @if ($merchant->is_active == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @elseif($merchant->is_active == 2)
                                                    <span class="badge badge-danger">Blocked</span>
                                                @elseif($merchant->is_active == 0)
                                                    <span class="badge badge-secondry">Not Active</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12">
                                        @if ($merchant->is_active == 1)
                                            <button data-toggle="modal" data-target="#blockModal"
                                                class="btn btn-outline-danger"><i class="fa fa-times-circle"></i> Block</a>
                                            @elseif($merchant->is_active == 0 || $merchant->is_active == 2)
                                                <a href="/admin-panel/merchants/status/{{ $merchant->id }}/1"
                                                    onclick="if(!confirm('Are You Sure ? ')){event.preventDefault();}"
                                                    class="btn btn-outline-success"><i class="fa fa-check-circle"></i>
                                                    Active</a>
                                        @endif
                                    <button data-toggle="modal" data-target="#alertModal"
                                        class="btn btn-outline-warning ml-1"><i class="fa fa-exclamation-triangle"></i>
                                        Warnings Alert</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- account end -->
                @if ($merchant->is_active == 2)
                <div class="col-md-6 col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-2">Block Info</div>
                        </div>
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td class="font-weight-bold">Block Type : </td>
                                    <td>
                                        @if ($merchant->block_type == 1)
                                            <span class="badge badge-warning">temporary Block</span>
                                        @elseif($merchant->is_active == 2)
                                            <span class="badge badge-danger">Permanent Block</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Block Reason : </td>
                                    <td>{{ $merchant->block_reason ?? '-' }}</td>
                                </tr>
                                @if ($merchant->block_type == 1)
                                    <tr>
                                        <td class="font-weight-bold">Active Date: </td>
                                        <td>{{ $merchant->active_date ?? '-' }}
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="font-weight-bold">Block By : </td>
                                    <td>{{ $merchant->block_by_admin->name ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
                <!-- social links end -->
                <div class="col-md-6 col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-2">Other Information</div>
                        </div>
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td class="font-weight-bold">UUID</td>
                                    <td>{{ $merchant->c_uuid ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Device Serial No</td>
                                    <td>{{ $merchant->serial_no ?? '-'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ip Address</td>
                                    <td>{{ $merchant->ip_address?? '-'}}
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Stores</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th>Store Name</th>
                                                <th>Category</th>
                                                <th>Business Phone</th>
                                                <th>Business Email</th>
                                                <th>General Discount</th>
                                                <th>Primary Store Language</th>
                                                <th>created At</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($merchant->stores->count() != 0)
                                            @foreach ($merchant->stores as $key => $store)
                                            <tr>
                                                <td style="min-width: 10px;">{{ ++$key }}</td>
                                                <td>
                                                    <div class="avatar mr-1 avatar-xl">
                                                        <img src="{{ asset($store->profile_pic) }}" alt="avtar img holder">
                                                    </div>
                                                </td>
                                                <td>{{ $store->store_name }}</td>
                                                <td>{{ $store->category->name_en }}</td>
                                                <td>{{ $store->business_phone }}</td>
                                                <td>{{ $store->business_email }}</td>
                                                <td>{{ $store->general_discount }}</td>
                                                <td>{{ $store->primary_language->language_name_en }}</td>
                                                <td>{{ $store->created_at->format('Y-m-d') }}</td>

                                                <td>
                                                    <a class="btn btn-info" name="edit_button"
                                                        href="/admin-panel/merchants/{{ $store->id }}"><i
                                                            class="fa fa-info"></i></a>

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
            </div>
        </section>
        <!-- page users view end -->
        <div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Block Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical"
                        action="/admin-panel/merchants/block_merchant/{{ $merchant->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Block Type</label>
                                        <select name="block_type"
                                            class="form-control @error('block_type') is-invalid @enderror" required>
                                            <option value="">Choose</option>
                                            <option value="1" @selected(old('block_type') == 1)>temporary Block
                                            </option>
                                            <option value="2" @selected(old('block_type') == 2)>Permanent Block
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Reason</label>
                                        <textarea name="block_reason" class="form-control @error('block_reason') is-invalid @enderror">{{ old('block_reason') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-none active_date">
                                    <div class="form-group">
                                        <label for="contact-info-vertical">Active Date</label>
                                        <input type="date" id="contact-info-vertical"
                                            class="form-control @error('active_date') is-invalid @enderror"
                                            name="active_date" value="{{ old('active_date') }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-danger mr-1 mb-1">Block</button>
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
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alert Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical"
                        action="/admin-panel/merchants/alert_merchant/{{ $merchant->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Alerts</label>
                                        <select name="warning_id"
                                            class="form-control @error('warning_id') is-invalid @enderror">
                                            <option value="">No Alert</option>
                                            @foreach ($alerts as $alert)
                                                <option value="{{ $alert->id }}" @selected(old('warning_id') ==  $alert->id )>{{ $alert->card_name_en }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-warning mr-1 mb-1">alert</button>
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
    </div>
@endsection
@section('scriptjs')
    <script>
        $(document).ready(function() {
            $("select[name='block_type']").change(function() {
                var block_type = this.value;
                if (block_type == 1) {
                    $('.active_date').removeClass('d-none');
                } else {
                    $('.active_date').addClass('d-none');
                }
            });
        });
    </script>

@endsection
