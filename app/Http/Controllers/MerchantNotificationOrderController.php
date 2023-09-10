<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMerchantNotificationOrderRequest;
use App\Http\Requests\UpdateMerchantNotificationOrderRequest;
use App\Models\MerchantNotificationOrder;
use App\Models\MerchantNotification;
use App\Models\NotificationCity;
use App\Models\NotificationState;
use App\Models\NotificationCountry;
use Illuminate\Http\Request;
use App\Models\NotificationCityOrder;
use App\Models\NotificationStateOrder;
use App\Models\NotificationCountryOrder;
use App\Models\Merchant;
use App\Models\InternalNotification;
use App\Models\StoreCity;
use App\Models\StoreState;
use App\Models\StoreCountry;
use Auth;
use Illuminate\Support\Facades\Http;

class MerchantNotificationOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notification_orders = auth()->user()->getNotificationOrders();
        if(request()->filled('search_item')){
            $notification_orders = $notification_orders->whereHas('store', function ($query) { 
                $query->where('store_name', 'like', '%'.request()->search_item.'%'); 
            })->orWherehas('merchant', function ($query) { 
                $query->whereHas('customer', function ($query) { 
                    $query->where('name', 'like', '%'.request()->search_item.'%'); 
                }); 
            });
        }
        $notification_orders = $notification_orders->orderby('id', 'Desc')->paginate(10);
        return view('notifications_orders.index')
            ->with('notification_orders', $notification_orders);
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
     * @param  \App\Http\Requests\StoreMerchantNotificationOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMerchantNotificationOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MerchantNotificationOrder  $merchantNotificationOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchantNotificationOrder = MerchantNotificationOrder::findOrFail($id);
        return view('notifications_orders.show')
            ->with('merchantNotificationOrder', $merchantNotificationOrder)
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MerchantNotificationOrder  $merchantNotificationOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(MerchantNotificationOrder $merchantNotificationOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMerchantNotificationOrderRequest  $request
     * @param  \App\Models\MerchantNotificationOrder  $merchantNotificationOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMerchantNotificationOrderRequest $request, MerchantNotificationOrder $merchantNotificationOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MerchantNotificationOrder  $merchantNotificationOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantNotificationOrder $merchantNotificationOrder)
    {
        //
    }

    public function changeStatus(Request $request, $id){
        $notificationOrder = MerchantNotificationOrder::findOrFail($id);
        // create internal notification 
        $internalNotification = new InternalNotification();
        $internalNotification->user_id = Auth::id();
        if($request->status_id == 2){ // Notification order Approved
            $internalNotification->type = 'Approved';
            $internalNotification->title = 'Approved Notification';
            $internalNotification->details = Auth::user()->name.' approved notification order no '.$notificationOrder->id;
            $response = Http::post( env('API_SERVER_URL').'/send-notifications/'.$id);
            if(!$response->ok()){
                toastr()->error('Acceptance notification can not be sent to customer, please try again later');
                return back();
            }
        } else if($request->status_id == 3){ // Notification order Rejected
            $notificationOrder->reject_reason = $request->reject_reason;
            $internalNotification->type = 'Reject';
            $internalNotification->title = 'Reject Notification';
            $internalNotification->details = Auth::user()->name.' Reject notification order no '.$notificationOrder->id;
        } else {  // Notification order Pending
            $internalNotification->type = 'Pending';
            $internalNotification->title = 'Pending Notification';
            $internalNotification->details = Auth::user()->name.' Pending notification order no '.$notificationOrder->id;
        }


        $notificationOrder->status_id = $request->status_id;
        $notificationOrder->update();

        $internalNotification->is_read = 0;
        $internalNotification->save();

        toastr()->success('Status Updated Successfully');
        return back();
    }

    // public function approve_order($order_id, $status_id)
    // {
        
    //     // if()

    //     $notification_order = MerchantNotificationOrder::findOrFail($order_id);
    //     $notification_order->status_id = $status_id;
    //     $notification_order->update();

    //     $notification = new MerchantNotification();
    //     $notification->merchant_id = $notification_order->merchant_id;
    //     $notification->store_id = $notification_order->store_id;
    //     $notification->launch_date = $notification_order->launch_date;
    //     $notification->age_range = $notification_order->age_range;
    //     $notification->gender = $notification_order->gender;
    //     $notification->category_id = $notification_order->category_id;
    //     $notification->reach_no = $notification_order->reach_no;
    //     $notification->notification_title_ar = $notification_order->notification_title_ar;
    //     $notification->notification_title_en = $notification_order->notification_title_en;
    //     $notification->notification_title_tr = $notification_order->notification_title_tr;
    //     $notification->notification_details_ar = $notification_order->notification_details_ar;
    //     $notification->notification_details_en = $notification_order->notification_details_en;
    //     $notification->notification_details_tr = $notification_order->notification_details_tr;
    //     $notification->primary_language = $notification_order->primary_language;
    //     $notification->notification_link = $notification_order->notification_link;
    //     $notification->status_id = $notification_order->status_id;
    //     $notification->is_active = 1;
    //     $notification->save();

    //     $notification_city_orders = NotificationCityOrder::where('notification_order_id', $notification_order->id)->get();
    //     if (count($notification_city_orders) != 0) {
    //         foreach ($notification_city_orders as $notification_city_order) {
    //             $notification_city = new NotificationCity();
    //             $notification_city->notification_id = $notification->id;
    //             $notification_city->city_id = $notification_city_order->city_id;
    //             $notification_city->save();
    //         }
    //     }

    //     $notification_state_orders = NotificationStateOrder::where('notification_order_id', $notification_order->id)->get();
    //     if (count($notification_state_orders) != 0) {
    //         foreach ($notification_state_orders as $notification_state_order) {
    //             $notification_state = new NotificationState();
    //             $notification_state->notification_id = $notification->id;
    //             $notification_state->state_id = $notification_state_order->state_id;
    //             $notification_state->save();
    //         }
    //     }

    //     $notification_country_orders = NotificationCountryOrder::where('notification_order_id', $notification_order->id)->get();
    //     if (count($notification_country_orders) != 0) {
    //         foreach ($notification_country_orders as $notification_country_order) {
    //             $notification_country = new NotificationCountry();
    //             $notification_country->notification_id = $notification->id;
    //             $notification_country->country_id = $notification_country_order->country_id;
    //             $notification_country->save();
    //         }
    //     }

    //     $internal_notification = new InternalNotification();
    //     $internal_notification->user_id = Auth::id();
    //     $internal_notification->type = 'Approved';
    //     $internal_notification->title = 'Approved Notification';
    //     $internal_notification->details = Auth::user()->name.' approved notification order no '.$notification_order->id;
    //     $internal_notification->is_read = 0;
    //     $internal_notification->save();

    //     toastr()->success('Status Updated Successfully');
    //     return back();
    // }

    // public function reject_order($order_id, Request $request)
    // {
    //     $validated = $request->validate([
    //         'status_id' => 'required|numeric|exists:store_banner_order_statuses,id',
    //         'reject_reason' => 'required|string',
    //     ]);

    //     $notification_order = MerchantNotificationOrder::findOrFail($order_id);
    //     $notification_order->status_id = $request->status_id;
    //     $notification_order->reject_reason = $request->reject_reason;
    //     $notification_order->update();

    //     $merchant = Merchant::where('id', $notification_order->merchant_id)->first();
    //     $merchant->wallet = $notification_order->price;
    //     $merchant->update();

    //     $internal_notification = new InternalNotification();
    //     $internal_notification->user_id = Auth::id();
    //     $internal_notification->type = 'Reject';
    //     $internal_notification->title = 'Reject Notification';
    //     $internal_notification->details = Auth::user()->name.' Reject notification order no '.$notification_order->id;
    //     $internal_notification->is_read = 0;
    //     $internal_notification->save();

    //     toastr()->success('Status Updated Successfully');
    //     return back();
    // }
}
