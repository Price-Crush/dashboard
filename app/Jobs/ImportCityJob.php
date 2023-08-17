<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class ImportCityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $headers = [
            'X-CSCAPI-KEY' => 'NkJLNTczSG8yYjFHMU8yUkpQTk9NYWc2MEV0NnRKQm45RjRkRG43Zg==',
            'Content-Type'=>'application/json',
        ];
        $http = Http::withHeaders($headers);
        $states = State::all();
        foreach($states as $state){
                $cities = $http->timeout(600)->get('https://api.countrystatecity.in/v1/countries/'.$state->country->country_code.'/states/'.$state->code.'/cities')->object();
                foreach($cities as $city){
                    City::create([
                        'state_id' =>  $state->id,
                        'name_ar' => $city?->name ?? '',
                        'name_en' => $city?->name ?? '',
                        'name_tr' => $city?->name ?? '',
                        'user_banner_price' => 0,
                    ]);
                }
        }
    }
    public function failed(\Throwable $e){
        info($e);
    }
}
