<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;
use App\Models\MerchantNotificationOrder;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationCountryOrder>
 */
class NotificationCountryOrderFactory extends Factory
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
            'notification_order_id' => $this->faker->randomElement(MerchantNotificationOrder::all())['id'],
        ];
    }
}
