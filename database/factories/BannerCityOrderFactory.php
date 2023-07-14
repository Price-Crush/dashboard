<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;
use App\Models\StoreBannerOrder;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BannerCityOrder>
 */
class BannerCityOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'city_id' => $this->faker->randomElement(City::all())['id'],
            'banner_order_id' => $this->faker->randomElement(StoreBannerOrder::all())['id'],
        ];
    }
}
