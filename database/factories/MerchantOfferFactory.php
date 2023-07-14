<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MerchantStore;
use App\Models\MerchantOfferStatus;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MerchantOffer>
 */
class MerchantOfferFactory extends Factory
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
            'description' => $this->faker->sentence,
            'from_date' => $this->faker->dateTime('-3 years')->format('d-m-Y'),
            'to_date' => $this->faker->dateTime('-1 years')->format('d-m-Y'),
            'price' => rand(1,6000),
            'image' => '/offer.jpeg',
            'status_id' => $this->faker->randomElement(MerchantOfferStatus::all())['id'],
        ];
    }
}
