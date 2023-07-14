<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MerchantStore;
use App\Models\Country;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreCountry>
 */
class StoreCountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'store_id' => $this->faker->randomElement(MerchantStore::all())['id'],
            'country_id' => $this->faker->randomElement(Country::all())['id'],
        ];
    }
}
