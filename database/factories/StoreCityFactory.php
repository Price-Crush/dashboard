<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MerchantStore;
use App\Models\City;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreCity>
 */
class StoreCityFactory extends Factory
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
            'city_id' => $this->faker->randomElement(City::all())['id'],
        ];
    }
}
