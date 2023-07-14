<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\MerchantStore;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerFavStore>
 */
class CustomerFavStoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->randomElement(Customer::where('is_anonymous',0)->get())['id'],
            'store_id' => $this->faker->randomElement(MerchantStore::all())['id'],
        ];
    }
}
