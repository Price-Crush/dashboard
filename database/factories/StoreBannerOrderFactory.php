<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Merchant;
use App\Models\MerchantStore;
use App\Models\StoreBannerOrderStatus;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreBannerOrder>
 */
class StoreBannerOrderFactory extends Factory
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
            'reach_no' => rand(1000,99999),
            'price' => rand(1000,99999),
            'description' => $this->faker->sentence,
            'reject_reason' => $this->faker->sentence,
            'order_serial' => Str::random(10),
            'image' => '/banner.jpg',
            'status_id' => $this->faker->randomElement(StoreBannerOrderStatus::all())['id'],
        ];
    }
}
