<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppSettingRequest;
use App\Http\Requests\UpdateAppSettingRequest;
use App\Models\AppSetting;

class AppSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = AppSetting::paginate(10);

        return view('app_settings.index')->with('settings',$settings);
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
     * @param  \App\Http\Requests\StoreAppSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppSettingRequest $request)
    {
        $app_setting = new AppSetting();
        $app_setting->name = $request->name;
        $app_setting->value = $request->value;
        $app_setting->save();

        toastr()->success('Data Saved Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppSetting  $appSetting
     * @return \Illuminate\Http\Response
     */
    public function show(AppSetting $appSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppSetting  $appSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(AppSetting $appSetting)
    {
        return view('app_settings.edit')->with('appSetting',$appSetting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAppSettingRequest  $request
     * @param  \App\Models\AppSetting  $appSetting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppSettingRequest $request, AppSetting $appSetting)
    {
        $appSetting->name = $request->name;
        $appSetting->value = $request->value;
        $appSetting->update();

        toastr()->success('Data Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppSetting  $appSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppSetting $appSetting)
    {
        //
    }
}
