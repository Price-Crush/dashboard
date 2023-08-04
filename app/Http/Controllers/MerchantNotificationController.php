<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMerchantNotificationRequest;
use App\Http\Requests\UpdateMerchantNotificationRequest;
use App\Models\MerchantNotification;
use App\Models\AdminCity;
use App\Models\AdminState;
use App\Models\AdminCountry;
use Auth;
class MerchantNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $notifications = MerchantNotification::orderby('id','Desc')->paginate(10);
        // $areas = '';
        // $promotion_level = '';

        // if(Auth::user()->promotion_level_id == 1)
        // {
        //     $areas = AdminCity::where('user_id',Auth::id())->get();
        //     $promotion_level = 'city';
        // }elseif(Auth::user()->promotion_level_id == 2)
        // {
        //     $areas = AdminState::where('user_id',Auth::id())->get();
        //     $promotion_level = 'state';
        // }elseif(Auth::user()->promotion_level_id == 3)
        // {
        //     $areas = AdminCountry::where('user_id',Auth::id())->get();
        //     $promotion_level = 'country';
        // }
        $notifications = auth()->user()->getMerchantNotifications();
        if(request()->filled('search_item')){
            $notifications = $notifications->where('notification_title_ar', 'like', '%'.request()->search_item.'%')
                ->orWhere('notification_title_en', 'like', '%'.request()->search_item.'%')
                ->orWhere('notification_title_tr', 'like', '%'.request()->search_item.'%')
                ->orWherehas('merchant', function ($query) { 
                    $query->whereHas('customer', function ($query) { 
                        $query->where('name', 'like', '%'.request()->search_item.'%'); 
                    }); 
                })->orWherehas('store', function ($query) { 
                    $query->where('store_name', 'like', '%'.request()->search_item.'%'); 
                });
        }
        $notifications = $notifications->orderby('id','Desc')->paginate(10);
        return view('notifications.index')
        ->with('notifications',$notifications)
        ->with('areas',null)
        ->with('promotion_level','')
        ;
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
     * @param  \App\Http\Requests\StoreMerchantNotificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMerchantNotificationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MerchantNotification  $merchantNotification
     * @return \Illuminate\Http\Response
     */
    public function show(MerchantNotification $merchantNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MerchantNotification  $merchantNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(MerchantNotification $merchantNotification)
    {
        return view('notifications.edit')->with('notification', $merchantNotification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMerchantNotificationRequest  $request
     * @param  \App\Models\MerchantNotification  $merchantNotification
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMerchantNotificationRequest $request, MerchantNotification $merchantNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MerchantNotification  $merchantNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantNotification $merchantNotification)
    {
        //
    }
}
