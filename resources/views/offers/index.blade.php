@extends('layouts.app')
@section('title', 'Offers')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Offers</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Offers</h4>
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
                        <form action="/admin-panel/offers/" method="get">
                            <div class="row">
                                <div class="col-lg-110 col-md-10">
                                    <input type="text" name="search_item" class="form-control" value="{{request()->search_item}}" placeholder="Type store name or description">
                                </div>
                                <div class="col-lg-1 col-md-2">
                                    <input type="submit" value="Search" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="table-responsive">
                            <table class="table" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Store Name</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>status</th>
                                        <th>created At</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($offers as $key => $offer)
                                        <tr>
                                            <td>{{ $offer->id }}</td>
                                            <td>
                                                <div class="avatar mr-1 avatar-xl">
                                                    <img src="{{ $offer->image ?? asset('logo.jpeg') }}" onerror="this.src='/logo.jpeg'  " alt="avtar img holder">
                                                </div>
                                            </td>
                                            <td>{{ $offer->store?->store_name }}</td>
                                            <td>{{ $offer->from_date }}</td>
                                            <td>{{ $offer->to_date }}</td>
                                            <td>
                                                @if ($offer->status_id == 1)
                                                    <span
                                                        class="badge badge-info">{{ $offer->status->name_en }}</span>
                                                @elseif($offer->status_id == 2)
                                                    <span
                                                        class="badge badge-success">{{ $offer->status->name_en }}</span>
                                                @elseif($offer->status_id == 3)
                                                    <span
                                                        class="badge badge-danger">{{ $offer->status->name_en }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $offer->created_at->format('Y-m-d') }}</td>

                                            <td>
                                                <a class="btn btn-info" name="edit_button"
                                                    href="/admin-panel/offers/{{ $offer->id }}"><i
                                                        class="fa fa-info"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{ $offers->appends(request()->all())->links() }}
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
@endsection
