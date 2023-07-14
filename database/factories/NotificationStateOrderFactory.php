<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\State;
use App\Models\MerchantNotificationOrder;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationStateOrder>
 */
class NotificationStateOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'state_id' => $this->faker->randomElement(State::all())['id'],
            'notification_order_id' => $this->faker->randomElement(MerchantNotificationOrder::all())['id'],
        ];
    }
}
