<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use App\Models\InternalNotification;
use App\Models\State;
use Auth;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::paginate(15);
        return view('countries.index')->with('countries', $countries);
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
     * @param  \App\Http\Requests\StoreCountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        $country = new Country();
        $country->country_code = $request->country_code;
        $country->country_enName = $request->country_enName;
        $country->country_arName = $request->country_arName;
        $country->country_trName = $request->country_trName;
        $country->country_enNationality = $request->country_enNationality;
        $country->country_arNationality = $request->country_arNationality;
        $country->country_trNationality = $request->country_trNationality;
        $country->price = $request->price;
        $country->google_ads = $request->google_ads;
        $country->save();

        toastr()->success('Data Saved Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('countries.edit')->with('country', $country);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountryRequest  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->country_code = $request->country_code;
        $country->country_enName = $request->country_enName;
        $country->country_arName = $request->country_arName;
        $country->country_trName = $request->country_trName;
        $country->country_enNationality = $request->country_enNationality;
        $country->country_arNationality = $request->country_arNationality;
        $country->country_trNationality = $request->country_trNationality;
        $country->price = $request->price;
        $country->google_ads = $request->google_ads;
        $country->update();

        if (count($country->getChanges()) != 0) {

            $internal_notification = new InternalNotification();
            $internal_notification->user_id = Auth::id();
            $internal_notification->type = 'Update';
            $internal_notification->title = 'Update Country';
            $internal_notification->details = Auth::user()->name . ' update data of ' . $country->country_enName;
            $internal_notification->is_read = 0;
            $internal_notification->save();
        }

        toastr()->success('Data Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $check_state = State::where('country_id', $country)->first();

        if ($check_state != null) {

            toastr()->error('You cannot delete country , country have states !!');
            return back();
        }

        $country->delete();

        toastr()->success('Data Deleted Successfully');
        return back();

    }
}
