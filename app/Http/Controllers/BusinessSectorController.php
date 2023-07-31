<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBusinessSectorRequest;
use App\Http\Requests\UpdateBusinessSectorRequest;
use App\Models\BusinessSector;
use App\Models\Customer;

class BusinessSectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = BusinessSector::orderby('id','Desc')->paginate(10);
        return view('business_sectors.index')->with('sectors',$sectors);
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
     * @param  \App\Http\Requests\StoreBusinessSectorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBusinessSectorRequest $request)
    {
        $businessSector = new BusinessSector();
        $businessSector->sector_name_ar = $request->sector_name_ar;
        $businessSector->sector_name_en = $request->sector_name_en;
        $businessSector->sector_name_tr = $request->sector_name_tr;
        $businessSector->save();

        toastr()->success('Data Saved Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessSector  $businessSector
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessSector $businessSector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessSector  $businessSector
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessSector $businessSector)
    {
        return view('business_sectors.edit')->with('businessSector',$businessSector);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBusinessSectorRequest  $request
     * @param  \App\Models\BusinessSector  $businessSector
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBusinessSectorRequest $request, BusinessSector $businessSector)
    {
        $businessSector->sector_name_ar = $request->sector_name_ar;
        $businessSector->sector_name_en = $request->sector_name_en;
        $businessSector->sector_name_tr = $request->sector_name_tr;
        $businessSector->update();

        toastr()->success('Data Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessSector  $businessSector
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessSector $businessSector)
    {
        $check_customer = Customer::where('business_sector_id', $businessSector->id)->first();

        if ($check_customer != null) {

            toastr()->error('You cannot delete business sector , Business Sector have customers !!');
            return back();
        }

        $businessSector->delete();

        toastr()->success('Data Deleted Successfully');
        return back();
    }
}
