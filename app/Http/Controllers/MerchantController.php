<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMerchantsRequest;
use App\Http\Requests\UpdateMerchantsRequest;
use App\Models\AdminCity;
use App\Models\AdminCountry;
use App\Models\AdminState;
use App\Models\InternalNotification;
use App\Models\Merchant;
use App\Models\MerchantWarningCard;
use Auth;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_type_id == 2) {
            $area_ids = [];
            $cities = [];
            $states = [];
            $countries = [];

            $cities_ids = [];
            $states_ids = [];
            $countries_ids = [];

            if (Auth::user()->promotion_level_id == 1) {
                $cities_ids = AdminCity::where('user_id', Auth::id())->get();
            } elseif (Auth::user()->promotion_level_id == 2) {
                $states_ids = AdminState::where('user_id', Auth::id())->get();
            } elseif (Auth::user()->promotion_level_id == 3) {
                $countries_ids = AdminCountry::where('user_id', Auth::id())->get();
            }

            foreach ($cities_ids as $city) {
                $cities[] = $city->city_id;
            }
            foreach ($states_ids as $state) {
                $states[] = $state->state_id;
            }
            foreach ($countries_ids as $country) {
                $countries[] = $country->country_id;
            }

            $merchants = Merchant::whereHas('country', function ($query) use ($countries) {
                if (count($countries) != 0) {
                    $query->wherein('country_id', $countries);
                }
            })
                ->whereHas('state', function ($query) use ($states) {
                    if (count($states) != 0) {
                        $query->wherein('state_id', $states);
                    }
                })
                ->whereHas('city', function ($query) use ($cities) {
                    if (count($cities) != 0) {
                        $query->wherein('city_id', $cities);
                    }
                })
                ->orderby('id', 'Desc')->get();
        } else {
            $merchants = Merchant::orderby('id', 'Desc')->get();

        }
        return view('merchants.index')
            ->with('merchants', $merchants)
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
     * @param  \App\Http\Requests\StoreMerchantsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMerchantsRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merchants  $merchants
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        $alerts = MerchantWarningCard::all();

        return view('merchants.show')
            ->with('merchant', $merchant)
            ->with('alerts', $alerts)
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merchants  $merchants
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchants $merchants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMerchantsRequest  $request
     * @param  \App\Models\Merchants  $merchants
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMerchantsRequest $request, Merchants $merchants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchants  $merchants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchants $merchants)
    {
        //
    }

    public function change_status($merchant_id, $status_id)
    {
        $merchant = Merchant::findOrFail($merchant_id);
        $merchant->is_active = $status_id;
        $merchant->update();

        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'Activate';
        $internal_notification->title = 'Activate Merchant';
        $internal_notification->details = Auth::user()->name . ' activate merchant ' . $merchant->name;
        $internal_notification->is_read = 0;
        $internal_notification->save();

        toastr()->success('Status Updated Successfully');
        return back();
    }

    public function block_merchant(Request $request, $id)
    {
        $validated = $request->validate([
            'block_type' => 'required|numeric',
            'block_reason' => 'required|string|max:255',
            'active_date' => 'nullable|string',
        ]);

        $merchant = Merchant::findOrFail($id);
        $merchant->is_active = 2;
        $merchant->block_type = $request->block_type;
        $merchant->block_reason = $request->block_reason;
        $merchant->block_by = Auth::id();
        if ($request->block_type == 1) {
            $merchant->active_date = $request->active_date;
        }
        $merchant->update();

        if (count($merchant->getChanges()) != 0) {
            $internal_notification = new InternalNotification();
            $internal_notification->user_id = Auth::id();
            $internal_notification->type = 'Block';
            $internal_notification->title = 'Block Merchant';
            $internal_notification->details = Auth::user()->name . ' block merchant ' . $merchant->name;
            $internal_notification->is_read = 0;
            $internal_notification->save();
        }

        toastr()->success('Status Updated Successfully');
        return back();
    }

    public function alert_merchant(Request $request, $id)
    {
        $validated = $request->validate([
            'warning_id' => 'nullable|numeric|exists:merchant_warning_cards,id',
        ]);

        $merchant = Merchant::findOrFail($id);
        $merchant->warning_id = $request->warning_id;
        $merchant->update();

        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'Alert';
        $internal_notification->title = 'Alert Merchant';
        $internal_notification->details = Auth::user()->name . ' alert merchant ' . $merchant->name;
        $internal_notification->is_read = 0;
        $internal_notification->save();

        toastr()->success('Status Updated Successfully');
        return back();
    }

}
