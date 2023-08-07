<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppSettingRequest;
use App\Http\Requests\UpdateAppSettingRequest;
use App\Models\AppSetting;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $settings = new AppSetting();
        // if(request()->filled('search_item')){
        //     $settings = $settings->where('name', 'like', '%'.request()->search_item.'%')
        //         ->orWhere('value', 'like', '%'.request()->search_item.'%');
        // }
        // $settings = $settings->orderby('id','desc')->paginate(10);

        $response = HTTP::get('https://timeapi.io/api/TimeZone/AvailableTimeZones');
        $timeZones =  ($response->ok())? json_decode($response->body()) : [];
        $settings = AppSetting::all()->pluck('value','name');
        return view('app_settings.index')->with([
            'settings'=>$settings,
            'timeZones'=>$timeZones
        ]);
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
    public function store(Request $request)
    {
        $settings = $request->except('_token');
        foreach($settings as $name=>$value){
            $app_setting = AppSetting::where('name',$name)->first();
            if(!$app_setting)
                $app_setting = new AppSetting();

            $app_setting->name = $name;
            $app_setting->value = $value;
            $app_setting->save(); 
        }

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
