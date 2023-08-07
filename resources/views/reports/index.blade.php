@extends('layouts.app')
@section('title', 'Stores Reports')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0"> Stores Reports</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Search Filter</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" action="/admin-panel/store-reports">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12 col-lg-2 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Countries</label>
                                            <select class="select2 form-control @error('country_id') is-invalid @enderror"
                                                name="country_id" >
                                                <option value="">Choose</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"@selected($country_id == $country->id)>
                                                        {{ $country->country_enName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">States</label>
                                            <select class="select2 form-control @error('state_id') is-invalid @enderror"
                                                name="state_id" >
                                                <option value="">Choose</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}"@selected($state_id == $state->id)>
                                                        {{ $state->name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">City</label>
                                            <select class="select2 form-control @error('city_id') is-invalid @enderror"
                                                name="city_id" >
                                                <option value="">Choose</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"@selected($city_id == $city->id)>
                                                        {{ $city->name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Categories</label>
                                            <select class="select2 form-control @error('category_id') is-invalid @enderror"
                                                name="category_id">
                                                <option value="">Choose</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"@selected($category_id == $category->id)>
                                                        {{ $category->name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Rates</label>
                                            <select class="select2 form-control @error('rate') is-invalid @enderror"
                                                name="rate">
                                                <option value="">Choose</option>
                                                <option value="0-1">0-1</option>
                                                <option value="1-2">1-2</option>
                                                <option value="2-3">2-3</option>
                                                <option value="3-4">3-4</option>
                                                <option value="4-5">4-5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2 mt-1">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Search</button>
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
                    <h4 class="card-title">Stores </h4>
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
                                        <th>Store Name</th>
                                        <th>Merchant Name</th>
                                        <th>Category</th>
                                        <th>Notification Orders</th>
                                        <th>Notification Orders Cost</th>
                                        <th>Banner Orders</th>
                                        <th>Banner Orders Cost</th>
                                        <th>General Discount</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>status</th>
                                        <th>rate</th>
                                        <th>created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stores as $key => $store)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $store->store_name }}</td>
                                            <td>
                                                <a
                                                    href="/admin-panel/merchants/{{ $store->merchant_id }}">{{ $store->merchant?->customer?->name }}</a>
                                            </td>
                                            <td>{{ $store->category->name_en }}</td>
                                            <td>{{ $store->notificationOrders->count() }}</td>
                                            <td>{{ $store->notificationOrders->sum('price') }}</td>
                                            <td>{{ $store->bannerOrders->count() }}</td>
                                            <td>{{ $store->bannerOrders->sum('price') }}</td>
                                            <td>% {{ $store->general_discount }}</td>
                                            <td>{{ $store->country->country_enName ?? '-' }}</td>
                                            <td>{{ $store->state->name_en ?? '-' }}</td>
                                            <td>{{ $store->city->name_en ?? '-' }}</td>
                                            <td>
                                                @if ($store->status_id == 1)
                                                    <span
                                                        class="badge badge-info">{{ $store->store_status->status_name_en }}</span>
                                                @elseif($store->status_id == 2)
                                                    <span
                                                        class="badge badge-success">{{ $store->store_status->status_name_en }}</span>
                                                @elseif($store->status_id == 3)
                                                    <span
                                                        class="badge badge-danger">{{ $store->store_status->status_name_en }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $store->rate }}
                                            </td>
                                            <td>{{ $store->created_at->format('Y-m-d') }}</td>


                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{$stores->appends(request()->all())->links()}}
                        </div>
                    </div>
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
    <script>
        $('.excel-html5-selectors').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    charset: 'utf-8',
                    bom: true,
                    filename: 'Stores Reports',
                    exportOptions: {
                        // columns: ':visible',
                        columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
                    }
                }
            ]
        });
    </script>

@endsection
