<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEducationalStatusRequest;
use App\Http\Requests\UpdateEducationalStatusRequest;
use App\Models\EducationalStatus;
use App\Models\Customer;

class EducationalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = new EducationalStatus();
        if(request()->filled('search_item')){
            $statuses = $statuses->where('educational_status_name_ar', 'like', '%'.request()->search_item.'%')
                ->orWhere('educational_status_name_en', 'like', '%'.request()->search_item.'%')
                ->orWhere('educational_status_name_tr', 'like', '%'.request()->search_item.'%');
        }
        $statuses = $statuses->orderby('id','desc')->paginate(10);

        return view('education_statuses.index')->with('statuses',$statuses);
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
     * @param  \App\Http\Requests\StoreEducationalStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEducationalStatusRequest $request)
    {
        $educationalStatus = new EducationalStatus();
        $educationalStatus->educational_status_name_ar = $request->educational_status_name_ar;
        $educationalStatus->educational_status_name_en = $request->educational_status_name_en;
        $educationalStatus->educational_status_name_tr = $request->educational_status_name_tr;
        $educationalStatus->save();

        toastr()->success('Data Saved Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EducationalStatus  $educationalStatus
     * @return \Illuminate\Http\Response
     */
    public function show(EducationalStatus $educationalStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EducationalStatus  $educationalStatus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $educationalStatus = EducationalStatus::findOrFail($id);
        return view('education_statuses.edit')
        ->with('educationalStatus',$educationalStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEducationalStatusRequest  $request
     * @param  \App\Models\EducationalStatus  $educationalStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEducationalStatusRequest $request,$id)
    {
        $educationalStatus = EducationalStatus::findOrFail($id);
        $educationalStatus->educational_status_name_ar = $request->educational_status_name_ar;
        $educationalStatus->educational_status_name_en = $request->educational_status_name_en;
        $educationalStatus->educational_status_name_tr = $request->educational_status_name_tr;
        $educationalStatus->update();

        toastr()->success('Data Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EducationalStatus  $educationalStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $educationalStatus = EducationalStatus::findOrFail($id);

        $check_customer = Customer::where('educational_status_id', $educationalStatus->id)->first();

        if ($check_customer != null) {

            toastr()->error('You cannot delete Education Status , Education Status have customers !!');
            return back();
        }

        $educationalStatus->delete();

        toastr()->success('Data Deleted Successfully');
        return back();
    }
}
