<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;
use App\Models\MerchantNotificationOrder;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationCityOrder>
 */
class NotificationCityOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'city_id' => $this->faker->randomElement(City::all())['id'],
            'notification_order_id' => $this->faker->randomElement(MerchantNotificationOrder::all())['id'],
        ];
    }
}
