<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = new State();
        if(request()->filled('search_item')){
            $states = $states->where('name_ar', 'like', '%'.request()->search_item.'%')
                ->orWhere('name_en', 'like', '%'.request()->search_item.'%')
                ->orWhere('name_tr', 'like', '%'.request()->search_item.'%');
        }
        $states = $states->orderby('id','desc')->paginate(10);

        $countries = Country::all();

        return view('states.index')
            ->with('states', $states)
            ->with('countries', $countries)
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
     * @param  \App\Http\Requests\StoreStateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStateRequest $request)
    {
        $state = new State();
        $state->country_id = $request->country_id;
        $state->name_ar = $request->name_ar;
        $state->name_en = $request->name_en;
        $state->name_tr = $request->name_tr;
        $state->price = $request->price;
        $state->user_banner_price = $request->user_banner_price; 
        $state->save();

        toastr()->success('Data Saved Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $countries = Country::all();
        return view('states.edit')
            ->with('countries', $countries)
            ->with('state', $state)
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStateRequest  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStateRequest $request, State $state)
    {
        $state->country_id = $request->country_id;
        $state->name_ar = $request->name_ar;
        $state->name_en = $request->name_en;
        $state->name_tr = $request->name_tr;
        $state->price = $request->price;
        $state->user_banner_price = $request->user_banner_price;
        $state->update();

        toastr()->success('Data Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $check_city = City::where('state_id', $state->id)->first();

        if ($check_city != null) {

            toastr()->error('You cannot state city , state have cities !!');
            return back();
        }

        $state->delete();

        toastr()->success('Data Deleted Successfully');
        return back();
    }
}
