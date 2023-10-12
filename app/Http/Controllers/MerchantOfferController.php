<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMerchantOfferRequest;
use App\Http\Requests\UpdateMerchantOfferRequest;
use App\Models\MerchantOffer;
use App\Models\MerchantOfferStatus;
use App\Models\InternalNotification;

use Auth;
use App\Services\FirebaseService;

class MerchantOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = auth()->user()->getMerchantOffers();
        if(request()->filled('search_item')){
            $offers = $offers->where('description_en', 'like', '%'.request()->search_item.'%')
                ->orWhere('description_ar', 'like', '%'.request()->search_item.'%')
                ->orWhere('description_tr', 'like', '%'.request()->search_item.'%')
                ->orWherehas('store', function ($query) { 
                    $query->where('store_name', 'like', '%'.request()->search_item.'%'); 
                });
        }
        $offers = $offers->orderby('id','Desc')->paginate(10);

        return view('offers.index')->with('offers',$offers);
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
     * @param  \App\Http\Requests\StoreMerchantOfferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMerchantOfferRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MerchantOffer  $merchantOffer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchantOffer = MerchantOffer::findOrFail($id);
        $statuses = MerchantOfferStatus::all();
        return view('offers.show')
        ->with('merchantOffer',$merchantOffer)
        ->with('statuses',$statuses)
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MerchantOffer  $merchantOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(MerchantOffer $merchantOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMerchantOfferRequest  $request
     * @param  \App\Models\MerchantOffer  $merchantOffer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMerchantOfferRequest $request, MerchantOffer $merchantOffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MerchantOffer  $merchantOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantOffer $merchantOffer)
    {
        //
    }

    public function change_status($id)
    {
        $offerNewStatus = MerchantOfferStatus::findOrFail(request()->status_id);
        $merchantOffer = MerchantOffer::findOrFail($id);
        $merchantOffer->status_id = request()->status_id;
        $merchantOffer->update();
       
        if(FirebaseService::sendNotification("Offer ".$offerNewStatus->name_en,
                "Your offer of ".$merchantOffer->store->store_name." store  is ".$offerNewStatus->name_en, 
                collect([$merchantOffer->store->merchant?->customer?->fcm_token]))) {
                toastr()->success('Offer '.$offerNewStatus->name_en.' Successfully.');

            } else {
                toastr()->error('Offer status updated, but we could not notify our merchant');
        }

        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'Change_Status';
        $internal_notification->title = 'Change Status';
        $internal_notification->details = Auth::user()->name.' change status of offer no. '.$merchantOffer->id .' from store '.$merchantOffer->store?->store_name;
        $internal_notification->is_read = 0;
        $internal_notification->save();

        return back();

    }
}
