<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MerchantStore;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'product_name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'price' => rand(1,1000),
            'image' => "/product_name.jpg",
            'is_private_discount' => 0,
            'is_active' => $this->faker->randomElement(['0', '1']),
        ];
    }
}
