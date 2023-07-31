<?php

namespace App\Http\Controllers;

use App\Models\BannerCity;
use App\Models\BannerCityOrder;
use App\Models\BannerCountry;
use App\Models\BannerCountryOrder;
use App\Models\BannerState;
use App\Models\BannerStateOrder;
use App\Models\Merchant;
use App\Models\StoreBanner;
use App\Models\StoreBannerOrder;
use App\Models\StoreBannerOrderStatus;
use Illuminate\Http\Request;
use App\Models\InternalNotification;
use Auth;
class BannerOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $banners = auth()->user()->getStoreBannerOrderOrders();
        if(request()->filled('search_item')){
            $banners = $banners->whereHas('store', function ($query) { 
                $query->where('store_name', 'like', '%'.request()->search_item.'%'); 
            })->orWherehas('merchant', function ($query) { 
                $query->whereHas('customer', function ($query) { 
                    $query->where('name', 'like', '%'.request()->search_item.'%'); 
                }); 
            });
        }
        $banners = $banners->orderby('id', 'Desc')->paginate(10);

        return view('banner_orders.index')
            ->with('banners', $banners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = StoreBannerOrder::findOrFail($id);
        $statuses = StoreBannerOrderStatus::all();

        return view('banner_orders.show')
            ->with('banner', $banner)
            ->with('statuses', $statuses)
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approve_order($order_id, $status_id)
    {
        $banner_order = StoreBannerOrder::findOrFail($order_id);
        $banner_order->status_id = $status_id;
        $banner_order->update();

        $banner = new StoreBanner();
        $banner->merchant_id = $banner_order->merchant_id;
        $banner->store_id = $banner_order->store_id;
        $banner->from_date = $banner_order->from_date;
        $banner->to_date = $banner_order->to_date;
        $banner->image = $banner_order->image;
        $banner->is_active = 1;
        $banner->save();

        $banner_city_orders = BannerCityOrder::where('banner_order_id', $banner_order->id)->get();
        if (count($banner_city_orders) != 0) {
            foreach ($banner_city_orders as $banner_city_order) {
                $banner_city = new BannerCity();
                $banner_city->banner_id = $banner->id;
                $banner_city->city_id = $banner_city_order->city_id;
                $banner_city->save();
            }
        }

        $banner_state_orders = BannerStateOrder::where('banner_order_id', $banner_order->id)->get();
        if (count($banner_state_orders) != 0) {
            foreach ($banner_state_orders as $banner_state_order) {
                $banner_state = new BannerState();
                $banner_state->banner_id = $banner->id;
                $banner_state->state_id = $banner_state_order->state_id;
                $banner_state->save();
            }
        }

        $banner_country_orders = BannerCountryOrder::where('banner_order_id', $banner_order->id)->get();
        if (count($banner_country_orders) != 0) {
            foreach ($banner_country_orders as $banner_country_order) {
                $banner_country = new BannerCountry();
                $banner_country->banner_id = $banner->id;
                $banner_country->country_id = $banner_country_order->country_id;
                $banner_country->save();
            }
        }

        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'Approved';
        $internal_notification->title = 'Approved Banner';
        $internal_notification->details = Auth::user()->name.' approved banner order no '.$banner_order->id;
        $internal_notification->is_read = 0;
        $internal_notification->save();


        toastr()->success('Status Updated Successfully');
        return back();
    }

    public function reject_order($order_id, Request $request)
    {
        $validated = $request->validate([
            'status_id' => 'required|numeric|exists:store_banner_order_statuses,id',
            'reject_reason' => 'required|string',
        ]);

        $banner_order = StoreBannerOrder::findOrFail($order_id);
        $banner_order->status_id = $request->status_id;
        $banner_order->reject_reason = $request->reject_reason;
        $banner_order->update();

        $merchant = Merchant::where('id', $banner_order->merchant_id)->first();
        $merchant->wallet = $banner_order->price;
        $merchant->update();

        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'Reject';
        $internal_notification->title = 'Reject Banner';
        $internal_notification->details = Auth::user()->name.' Reject banner order no '.$banner_order->id;
        $internal_notification->is_read = 0;
        $internal_notification->save();

        toastr()->success('Status Updated Successfully');
        return back();
    }
}
