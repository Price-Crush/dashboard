@extends('layouts.app')
@section('title', 'Areas')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">User Areas</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Areas Management</h4>
                </div>

                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="row">
                        <div class="col-12">
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
                                                        <th>Stores </th>
                                                        <th>Notification Orders </th>
                                                        <th>Notification Orders Income</th>
                                                        <th>Banner Orders </th>
                                                        <th>Banner Orders Income</th>
                                                        <th>Merchants</th>
                                                        <th>Customers</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (auth()->user()->executive_cities->count() != 0)
                                                        @foreach (auth()->user()->executive_cities as $key => $city)
                                                            <tr>
                                                                <th scope="row">{{ ++$key }}</th>
                                                                <td>{{ $city->cities->name_en }}</td>
                                                                <td>{{ $city->stores?->count() ?? 0 }}</td>
                                                                <td>{{ number_format($city->notificationOrdersCount())  }}</td>
                                                                <td>{{ number_format($city->notificationOrdersIncome(),2)  }}</td>
                                                                <td>{{ number_format($city->bannerOrdersCount())  }}</td>
                                                                <td>{{ number_format($city->bannerOrdersIncome(),2)  }}</td>
                                                                <td>{{ number_format($city->merchants?->count())  }}</td>
                                                                <td>{{ number_format($city->customers?->count())  }}</td>
                                                                
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
                        <div class="col-12">
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
                                                        <th>Stores </th>
                                                        <th>Notification Orders </th>
                                                        <th>Notification Orders Income</th>
                                                        <th>Banner Orders </th>
                                                        <th>Banner Orders Income</th>
                                                        <th>Merchants</th>
                                                        <th>Customers</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (auth()->user()->executive_states->count() != 0)
                                                        @foreach (auth()->user()->executive_states as $key => $state)
                                                            <tr>
                                                                <th scope="row">{{ ++$key }}</th>
                                                                <td>{{ $state->state->name_en }}</td>
                                                                <td>{{ $state->stores?->count() ?? 0 }}</td>
                                                                <td>{{ number_format($state->notificationOrdersCount())  }}</td>
                                                                <td>{{ number_format($state->notificationOrdersIncome(),2)  }}</td>
                                                                <td>{{ number_format($state->bannerOrdersCount())  }}</td>
                                                                <td>{{ number_format($state->bannerOrdersIncome(),2)  }}</td>
                                                                <td>{{ number_format($state->merchants?->count())  }}</td>
                                                                <td>{{ number_format($state->customers?->count())  }}</td>
                                                                
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
                        <div class="col-12">
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
                                                        <th>Stores </th>
                                                        <th>Notification Orders </th>
                                                        <th>Notification Orders Income</th>
                                                        <th>Banner Orders </th>
                                                        <th>Banner Orders Income</th>
                                                        <th>Merchants</th>
                                                        <th>Customers</th>
                                                </thead>
                                                <tbody>
                                                    @if (auth()->user()->executive_countries->count() != 0)
                                                        @foreach (auth()->user()->executive_countries as $key => $country)
                                                            <tr>
                                                                <th scope="row">{{ ++$key }}</th>
                                                                <td>{{ $country->country->country_enName }}</td>
                                                                <td>{{ $country->stores?->count() ?? 0 }}</td>
                                                                <td>{{ number_format($country->notificationOrdersCount())  }}</td>
                                                                <td>{{ number_format($country->notificationOrdersIncome(),2)  }}</td>
                                                                <td>{{ number_format($country->bannerOrdersCount())  }}</td>
                                                                <td>{{ number_format($country->bannerOrdersIncome(),2)  }}</td>
                                                                <td>{{ number_format($country->merchants?->count())  }}</td>
                                                                <td>{{ number_format($country->customers?->count())  }}</td>
                                                                
                                                                
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


@endsection
