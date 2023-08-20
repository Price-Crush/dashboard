@extends('layouts.app')
@section('title', 'App Settings')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0"> App Settings </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> App Settings </h4>
                </div>

                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <form action="{{route('app-settings.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Income Tax Status</label>
                                        <select name="income_tax_status" id="" class="form-control" required>
                                            <option value="true" @selected($settings['income_tax_status']=='true')>True</option>
                                            <option value="false" @selected($settings['income_tax_status']=='false')>False</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Income Tax Precentage (%)</label>
                                        <input type="number" name="income_tax_value" value="{{$settings['income_tax_value']}}" class="form-control" step="0.00001" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Primary Currency </label>
                                        <select name="primary_currency" id="" class="form-control" required>
                                            @foreach(App\Models\Currency::all() as $currency)
                                                <option value="{{$currency->id}}" @selected($settings['primary_currency']==$currency->id)>{{$currency->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Time Zone </label>
                                        <select name="timeـzone" id="" class="form-control select2" required>
                                            @foreach($timeZones as $timeZone)
                                                <option value="{{$timeZone}}" @selected($settings['timeـzone']==$timeZone)>{{$timeZone}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Notification General Price (Per User)</label>
                                        <input type="number" name="notification_general_price" value="{{$settings['notification_general_price']}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Promotion Days</label>
                                        <input type="number" name="promotion_days" value="{{$settings['promotion_days']}}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Notifications Gift </label>
                                        <input type="number" name="notifications_gift" value="{{$settings['notifications_gift']}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Offers Gift</label>
                                        <input type="number" name="offers_gift" value="{{$settings['offers_gift']}}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Educational Arabic Video URL </label>
                                        <input type="text" name="educational_video_ar" value="{{$settings['educational_video_ar']}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Educational English Video URL </label>
                                        <input type="text" name="educational_video_en" value="{{$settings['educational_video_en']}}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Educational Turkey Video URL </label>
                                        <input type="text" name="educational_video_tr" value="{{$settings['educational_video_tr']}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Banner Max Days </label>
                                        <input type="number" name="banner_max_days" value="{{$settings['banner_max_days']}}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Google Ads</label>
                                        <select name="google_ads" id="" class="form-control" required>
                                            <option value="On" @selected($settings['google_ads']=='On')>On</option>
                                            <option value="Off" @selected($settings['google_ads']=='Off')>Off</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
