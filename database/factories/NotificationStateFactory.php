<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MerchantNotificationOrder;
use App\Models\State;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationState>
 */
class NotificationStateFactory extends Factory
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
