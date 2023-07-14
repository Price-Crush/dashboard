<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Merchant;
use App\Models\MerchantStore;
use App\Models\Category;
use App\Models\Language;
use App\Models\MerchantNotificationOrderStatus;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MerchantNotificationOrder>
 */
class MerchantNotificationOrderFactory extends Factory
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
            'launch_date' =>  $this->faker->dateTime('-1 years')->format('d-m-Y'),
            'age_range' =>  rand(20,30).'-'.rand(30,50),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'category_id' => $this->faker->randomElement(Category::all())['id'],
            'reach_no' => rand(1000,99999),
            'price' => rand(1000,50000),
            'notification_title_ar' => $this->faker->sentence,
            'notification_title_en' => $this->faker->sentence,
            'notification_title_tr' => $this->faker->sentence,
            'notification_details_ar' => $this->faker->sentence,
            'notification_details_en' => $this->faker->sentence,
            'notification_details_tr' => $this->faker->sentence,
            'primary_language' => $this->faker->randomElement(Language::all())['id'],
            'notification_link' => $this->faker->url,
            'status_id' => $this->faker->randomElement(MerchantNotificationOrderStatus::all())['id'],
            'reject_reason' => $this->faker->sentence,
            'order_serial' =>  Str::random(10),
        ];
    }
}
