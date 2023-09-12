<?php

namespace App\Http\Controllers;

use App\Models\AdminCity;
use App\Models\AdminCountry;
use App\Models\AdminState;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\MerchantStore;
use App\Models\State;
use App\Models\StoreCountry;
use App\Models\StoreState;
use App\Models\StoreCity;
use App\Models\StoreCategory;

use Auth;
use Illuminate\Http\Request;

class StoreReportsController extends Controller
{
    public function stores_reports()
    {
        $stores = auth()->user()->getStores();
        $cities = request()->filled('state_id')? State::find(request()->state_id)->cities : [];
        $states = request()->filled('country_id')? Country::find(request()->country_id)->states : [];
        $countries = country::all();
        $categories = Category::all();

        $country_id = '';
        $state_id = '';
        $city_id = '';
        $category_id = '';
        $rate = '';
        
        if(request()->filled('city_id')){
            $storeIds = StoreCity::where('city_id',request()->city_id)->pluck('store_id');
            $stores = $stores->whereIn('id', $storeIds);
        } else if(request()->filled('state_id')){
            $storeIds = StoreState::where('state_id',request()->state_id)->pluck('store_id');
            $stores = $stores->whereIn('id', $storeIds);
        } else if(request()->filled('country_id')){
            $storeIds = StoreCountry::where('country_id',request()->country_id)->pluck('store_id');
            $stores = $stores->whereIn('id', $storeIds);
        }
        
        if(request()->filled('category_id')){
            $storeIds = StoreCategory::where('category_id',request()->category_id)->pluck('store_id');
            $stores = $stores->whereIn('id', $storeIds);
        }
        if(request()->filled('rate')){
            $rate = request()->rate;
            $stores = $stores->where('rate', $rate);
        }
       
        $stores = $stores->orderBy('id','desc')->paginate(10);
        return view('reports.index')->with([
            'stores' => $stores,
            'cities' => $cities,
            'states' => $states,
            'countries' => $countries,
            'categories' => $categories,
            'country_id' => request()->country_id,
            'state_id' => request()->state_id,
            'city_id' => request()->city_id,
            'category_id' => request()->category_id,
            'rate' => $rate,
            ]);
    }
}
