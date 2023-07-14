<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\InternalNotification;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use Auth;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::orderby('id','Desc')->get();
        return view('languages.index')->with('languages',$languages);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLanguageRequest $request)
    {
        $language = new Language();
        $language->language_name_ar = $request->language_name_ar;
        $language->language_name_en = $request->language_name_en;
        $language->language_name_tr = $request->language_name_tr;
        $language->language_code = $request->language_code;
        $language->save();


        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'New';
        $internal_notification->title = 'New Language';
        $internal_notification->details = Auth::user()->name.' Add a new language';
        $internal_notification->is_read = 0;
        $internal_notification->save();

        toastr()->success('Data Saved Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('languages.edit')->with('language',$language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLanguageRequest $request, $id)
    {
        $language = Language::findOrFail($id);
        $language->language_name_ar = $request->language_name_ar;
        $language->language_name_en = $request->language_name_en;
        $language->language_name_tr = $request->language_name_tr;
        $language->language_code = $request->language_code;
        $language->update();

        if(count($language->getChanges()) != 0)
        {

            $internal_notification = new InternalNotification();
            $internal_notification->user_id = Auth::id();
            $internal_notification->type = 'Updated';
            $internal_notification->title = 'Update Language';
            $internal_notification->details = Auth::user()->name.' Update a language '.$request->language_name_en;
            $internal_notification->is_read = 0;
            $internal_notification->save();
        }

        toastr()->success('Data Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Language::findOrFail($id)->delete();
        toastr()->success('Data Deleted Successfully');
        return back();
    }
}
