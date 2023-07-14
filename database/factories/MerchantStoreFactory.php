<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Merchant;
use App\Models\Category;
use App\Models\Language;
use App\Models\MerchantStoreStatus;
use App\Models\StoreAppearanceLevel;
use App\Models\City;
use App\Models\State;
use App\Models\Country;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MerchantStore>
 */
class MerchantStoreFactory extends Factory
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
            'store_name' => $this->faker->name,
            'about_store' => $this->faker->sentence,
            'about_store' => $this->faker->sentence,
            'profile_pic' => '/store.png',
            'business_license' => rand(1111111111,999999999),
            'business_license' => rand(1111111111,999999999),
            'phone' => $this->faker->numerify('#########'),
            'business_phone' => $this->faker->numerify('#########'),
            'whatsapp_phone' => $this->faker->numerify('#########'),
            'business_email' => $this->faker->unique()->safeEmail,
            'facebook' => $this->faker->url,
            'instagram' => $this->faker->url,
            'general_discount' => rand(1,50),
            'category_id' => $this->faker->randomElement(Category::all())['id'],
            'primary_store_language' => $this->faker->randomElement(Language::all())['id'],
            'second_store_language' => $this->faker->randomElement(Language::all())['id'],
            'store_description' => $this->faker->sentence,
            'lat' => $this->faker->latitude,
            'long' => $this->faker->longitude,
            'status_id' => $this->faker->randomElement(MerchantStoreStatus::all())['id'],
            'appearance_level_id' => $this->faker->randomElement(StoreAppearanceLevel::all())['id'],
            'city_id' =>  $this->faker->randomElement(City::all())['id'],
            'state_id' =>  $this->faker->randomElement(State::all())['id'],
            'country_id' =>  $this->faker->randomElement(Country::all())['id'],
        ];
    }
}
