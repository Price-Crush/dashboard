<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Merchant;
use App\Models\MerchantStore;
use App\Models\City;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreBanner>
 */
class StoreBannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'merchant_id' => $this->faker->randomElement(Merchant::all())['id'],
            'store_id' => $this->faker->randomElement(MerchantStore::all())['id'],
            'from_date' => $this->faker->dateTime('-2 years')->format('d-m-Y'),
            'to_date' => $this->faker->dateTime('-1 years')->format('d-m-Y'),
            'image' => '/banner.jpg',
            'is_active' => $this->faker->randomElement(['0', '1']),
        ];
    }
}
