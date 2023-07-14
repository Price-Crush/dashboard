<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MerchantStore;
use App\Models\Customer;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreRate>
 */
class StoreRateFactory extends Factory
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
            'customer_id' => $this->faker->randomElement(Customer::where('is_anonymous',0)->get())['id'],
            'rating' => rand(1,5),
            'review' => $this->faker->sentence,
        ];
    }
}
