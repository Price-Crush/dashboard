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
use Auth;
use Illuminate\Http\Request;

class StoreReportsController extends Controller
{
    public function stores_reports()
    {
        if (Auth::user()->user_type_id == 2) {
            $area_ids = [];
            $cities = [];
            $states = [];
            $countries = [];

            $cities_ids = [];
            $states_ids = [];
            $countries_ids = [];

            if (Auth::user()->promotion_level_id == 1) {
                $cities_ids = AdminCity::where('user_id', Auth::id())->get();
            } elseif (Auth::user()->promotion_level_id == 2) {
                $states_ids = AdminState::where('user_id', Auth::id())->get();
            } elseif (Auth::user()->promotion_level_id == 3) {
                $countries_ids = AdminCountry::where('user_id', Auth::id())->get();
            }

            foreach ($cities_ids as $city) {
                $cities[] = $city->city_id;
            }
            foreach ($states_ids as $state) {
                $states[] = $state->state_id;
            }
            foreach ($countries_ids as $country) {
                $countries[] = $country->country_id;
            }

            $stores = MerchantStore::whereHas('country', function ($query) use ($countries) {
                if (count($countries) != 0) {
                    if (request()->country_id == null) {
                        $query->wherein('country_id', $countries);
                    } else {
                        $query->where('country_id', request()->country_id);
                    }
                }
            })
                ->whereHas('state', function ($query) use ($states) {
                    if (count($states) != 0) {
                        if (request()->state_id == null) {
                            $query->wherein('state_id', $states);
                        } else {
                            $query->where('state_id', request()->state_id);
                        }
                    }
                })
                ->whereHas('city', function ($query) use ($cities) {
                    if (count($cities) != 0) {
                        if (request()->city_id == null) {
                            $query->wherein('city_id', $cities);
                        } else {
                            $query->where('city_id', request()->city_id);
                        }
                    }
                })
                ->where(function ($query) {
                    if (request()->category_id != null) {
                        $query->where('category_id', request()->category_id);
                    }
                })
                ->where(function ($query) {
                    if (request()->rate != null) {
                        $query->where('rate', request()->rate);
                    }
                })
                ->orderby('id', 'Desc')->get();

            $cities = AdminCity::where('user_id', Auth::id())->get();
            $states = AdminState::where('user_id', Auth::id())->get();
            $countries = AdminCountry::where('user_id', Auth::id())->get();

        } else {

            $cities = City::all();
            $states = State::all();
            $countries = Country::all();

            $stores = MerchantStore::where(function ($query) {
                if (isset(request()->country_id) && request()->country_id != null) {
                    $query->where('country_id', request()->country_id);
                }
            })
                ->where(function ($query) {
                    if (isset(request()->state_id) && request()->state_id != null) {
                        $query->where('state_id', request()->state_id);
                    }
                })
                ->where(function ($query) {
                    if (isset(request()->city_id) && request()->city_id != null) {
                        $query->where('city_id', request()->city_id);
                    }
                })
                ->where(function ($query) {
                    if (isset(request()->category_id) && request()->category_id != null) {
                        $query->where('category_id', request()->category_id);
                    }
                })
                ->where(function ($query) {
                    if (isset(request()->rate) && request()->rate != null) {
                        $rates = explode("-", request()->rate);

                        $query->whereBetween('rate',$rates);
                    }
                })->orderby('id', 'Desc')->get();

        }
        $categories = Category::all();

        return view('reports.index')
            ->with('stores', $stores)
            ->with('cities', $cities)
            ->with('states', $states)
            ->with('countries', $countries)
            ->with('categories', $categories)
        ;
    }
}
