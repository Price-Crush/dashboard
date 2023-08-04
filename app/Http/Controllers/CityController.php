<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\State;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $cities = new City();
        if(request()->filled('search_item')){
            $cities = $cities->where('name_ar', 'like', '%'.request()->search_item.'%')
                ->orWhere('name_en', 'like', '%'.request()->search_item.'%')
                ->orWhere('name_tr', 'like', '%'.request()->search_item.'%');
        }
        $cities = $cities->orderby('id','desc')->paginate(10);
        $states = State::all();

        return view('cities.index')
            ->with('cities', $cities)
            ->with('states', $states)
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
     * @param  \App\Http\Requests\StoreCityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
        $city = new City();
        $city->state_id = $request->state_id;
        $city->name_ar = $request->name_ar;
        $city->name_en = $request->name_en;
        $city->name_tr = $request->name_tr;
        $city->price = $request->price;
        $city->save();

        toastr()->success('Data Saved Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $states = State::all();

        return view('cities.edit')
            ->with('city', $city)
            ->with('states', $states)
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCityRequest  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $city->state_id = $request->state_id;
        $city->name_ar = $request->name_ar;
        $city->name_en = $request->name_en;
        $city->name_tr = $request->name_tr;
        $city->price = $request->price;
        $city->save();

        toastr()->success('Data Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {

        $city->delete();

        toastr()->success('Data Deleted Successfully');
        return back();
    }
}
