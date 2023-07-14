<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;
use App\Models\StoreBannerOrder;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BannerCountryOrder>
 */
class BannerCountryOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'country_id' => $this->faker->randomElement(Country::all())['id'],
            'banner_order_id' => $this->faker->randomElement(StoreBannerOrder::all())['id'],
        ];
    }
}
