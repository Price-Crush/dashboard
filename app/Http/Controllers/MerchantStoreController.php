<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMerchantStoreRequest;
use App\Http\Requests\UpdateMerchantStoreRequest;
use App\Models\MerchantStore;
use App\Models\MerchantStoreStatus;
use App\Models\StoreRate;
use App\Models\AdminCity;
use App\Models\AdminCountry;
use App\Models\AdminState;
use Auth;
use App\Models\InternalNotification;
use App\Models\AppSetting;
use App\Services\FirebaseService;

class MerchantStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth::user()->user_type_id == 2) {
        //     $area_ids = [];
        //     $cities = [];
        //     $states = [];
        //     $countries = [];

        //     $cities_ids = [];
        //     $states_ids = [];
        //     $countries_ids = [];

        //     if (Auth::user()->promotion_level_id == 1) {
        //         $cities_ids = AdminCity::where('user_id', Auth::id())->get();
        //     } elseif (Auth::user()->promotion_level_id == 2) {
        //         $states_ids = AdminState::where('user_id', Auth::id())->get();
        //     } elseif (Auth::user()->promotion_level_id == 3) {
        //         $countries_ids = AdminCountry::where('user_id', Auth::id())->get();
        //     }

        //     foreach ($cities_ids as $city) {
        //         $cities[] = $city->city_id;
        //     }
        //     foreach ($states_ids as $state) {
        //         $states[] = $state->state_id;
        //     }
        //     foreach ($countries_ids as $country) {
        //         $countries[] = $country->country_id;
        //     }

        //     $stores = MerchantStore::whereHas('country', function ($query) use ($countries) {
        //         if (count($countries) != 0) {
        //             $query->wherein('country_id', $countries);
        //         }
        //     })
        //         ->whereHas('state', function ($query) use ($states) {
        //             if (count($states) != 0) {
        //                 $query->wherein('state_id', $states);
        //             }
        //         })
        //         ->whereHas('city', function ($query) use ($cities){
        //             if (count($cities) != 0) {
        //             $query->wherein('city_id', $cities);
        //             }
        //         })
        //         ->orderby('id', 'Desc')->paginate(10);
        // } else {
        //     $stores = MerchantStore::orderby('id', 'Desc')->paginate(10);
        // }
        
        $stores = auth()->user()->getStores();
        if(request()->filled('search_item')){
            $stores = $stores->where('store_name', 'like', '%'.request()->search_item.'%')
                ->orWhere('business_phone', 'like', '%'.request()->search_item.'%')
                ->orWhere('business_email', 'like', '%'.request()->search_item.'%')
                ->orWherehas('merchant', function ($query) { 
                    $query->whereHas('customer', function ($query) { 
                        $query->where('name', 'like', '%'.request()->search_item.'%'); 
                    }); 
                });
        }

        $stores = $stores->orderby('id', 'Desc')->paginate(10);
        return view('stores.index')
            ->with('stores', $stores)
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
     * @param  \App\Http\Requests\StoreMerchantStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMerchantStoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MerchantStore  $merchantStore
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchantStore = MerchantStore::where('id', $id)->first();
        $merchantStore->setRelation('notificationOrders', $merchantStore->notificationOrders()->paginate(10));
        $statuses = MerchantStoreStatus::all();

        return view('stores.show')
            ->with('merchantStore', $merchantStore)
            ->with('statuses', $statuses)
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MerchantStore  $merchantStore
     * @return \Illuminate\Http\Response
     */
    public function edit(MerchantStore $merchantStore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMerchantStoreRequest  $request
     * @param  \App\Models\MerchantStore  $merchantStore
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMerchantStoreRequest $request, MerchantStore $merchantStore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MerchantStore  $merchantStore
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantStore $merchantStore)
    {
        //
    }

    public function change_status($id)
    {

        $merchantStore = MerchantStore::findOrFail($id);
        if(request()->status_id == 2){
            if(FirebaseService::sendNotification("Store Acceptance","This is to inform you your store is accepted", collect([$merchantStore->merchant?->customer?->fcm_token])))
                $merchantStore->merchant->notifications_balance+=AppSetting::where('name','notifications_gift')->first()->value;
            else{
                toastr()->error('Notification could not be sent, please check the internet connectivity and try again later');
                return back();
            }
        }
        $merchantStore->status_id = request()->status_id;
        $merchantStore->update();

        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'Change_Status';
        $internal_notification->title = 'Change Status';
        $internal_notification->details = Auth::user()->name.' change status of store '.$merchantStore->store_name .' to '.$merchantStore->store_status->status_name_en;
        $internal_notification->is_read = 0;
        $internal_notification->save();

        toastr()->success('Data Updated Successfully');
        return back();

    }

    public function rate_change_status($rate_id, $status_id)
    {
        $rate = StoreRate::findOrFail($rate_id);
        $rate->is_active = $status_id;
        $rate->update();

        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'Change_Status';
        $internal_notification->title = 'Change Status';
        $internal_notification->details = Auth::user()->name.' change status of review '.$rate->review;
        $internal_notification->is_read = 0;
        $internal_notification->save();

        toastr()->success('Status Updated Successfully');
        return back();
    }
}
