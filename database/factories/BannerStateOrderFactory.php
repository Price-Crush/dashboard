<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\State;
use App\Models\StoreBannerOrder;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BannerStateOrder>
 */
class BannerStateOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'state_id' => $this->faker->randomElement(State::all())['id'],
            'banner_order_id' => $this->faker->randomElement(StoreBannerOrder::all())['id'],
        ];
    }
}
