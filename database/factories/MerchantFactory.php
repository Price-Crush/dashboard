<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Merchants>
 */
class MerchantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'family_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->numerify('#########'),
            'dob' => $this->faker->dateTime('-17 years')->format('d-m-Y'),
            'national_id' => rand(111111111111111,999999999999999),
            'profile_pic' => '/user_default2.jpg',
            'is_active' => $this->faker->randomElement(['0', '1']),
            'active_date' => $this->faker->dateTime('-3 years')->format('d-m-Y H:i:s'),
            'last_login' => $this->faker->dateTime('-1 years')->format('d-m-Y H:i:s'),
            'city_id' =>  $this->faker->randomElement(City::all())['id'],
            'state_id' =>  $this->faker->randomElement(State::all())['id'],
            'country_id' =>  $this->faker->randomElement(Country::all())['id'],
        ];
    }
}
