<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMerchantLevelRequest;
use App\Http\Requests\UpdateMerchantLevelRequest;
use App\Models\MerchantLevel;

class MerchantLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreMerchantLevelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMerchantLevelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MerchantLevel  $merchantLevel
     * @return \Illuminate\Http\Response
     */
    public function show(MerchantLevel $merchantLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MerchantLevel  $merchantLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(MerchantLevel $merchantLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMerchantLevelRequest  $request
     * @param  \App\Models\MerchantLevel  $merchantLevel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMerchantLevelRequest $request, MerchantLevel $merchantLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MerchantLevel  $merchantLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantLevel $merchantLevel)
    {
        //
    }
}
