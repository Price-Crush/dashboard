<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::orderby('id','Desc')->paginate(10);
        return view('currencies.index')->with('currencies', $currencies);
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
    public function store(StoreCurrencyRequest $request)
    {

        $currency = new Currency();
        $currency->name = $request->name;
        $currency->code = $request->code;
        $currency->symbol = $request->symbol;
        $currency->format = $request->format;
        $currency->exchange_rate = $request->exchange_rate;
        $currency->active = $request->active;
        $currency->save();

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
        $currency = Currency::findOrFail($id);
        return view('currencies.edit')->with('currency', $currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCurrencyRequest $request, $id)
    {
        $currency = Currency::findOrFail($id);
        $currency->name = $request->name;
        $currency->code = $request->code;
        $currency->symbol = $request->symbol;
        $currency->format = $request->format;
        $currency->exchange_rate = $request->exchange_rate;
        $currency->active = $request->active;
        $currency->update();

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
        $currency = Currency::findOrFail($id)->delete();
        toastr()->success('Data Deleted Successfully');
        return back();
    }
}
