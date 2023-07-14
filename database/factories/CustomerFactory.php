<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BusinessSector;
use App\Models\EducationalStatus;
use App\Models\Country;
use App\Models\language;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->numerify('#########'),
            'dob' => $this->faker->dateTime('-17 years')->format('d-m-Y H:i:s'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'business_sector_id' => $this->faker->randomElement(BusinessSector::all())['id'],
            'educational_status_id' => $this->faker->randomElement(EducationalStatus::all())['id'],
            'nationality_id' => $this->faker->randomElement(Country::wherein('id',['226','209','232','194'])->get())['id'],
            'resident_country' => $this->faker->randomElement(Country::wherein('id',['226','209','232','194'])->get())['id'],
            'state_id' => $this->faker->randomElement(State::all())['id'],
            'city_id' => $this->faker->randomElement(City::all())['id'],
            'fav_lang' => $this->faker->randomElement(language::all())['id'],
            'sec_fav_lang' => $this->faker->randomElement(language::all())['id'],
            'profile_pic' => '/user_default.jpg',
            'is_active' => $this->faker->randomElement(['0', '1']),
            'otp' => rand(11111,99999),
            'otp_expired' => $this->faker->dateTime('-17 years')->format('d-m-Y H:i:s'),
            'last_login' => $this->faker->dateTime('-17 years')->format('d-m-Y H:i:s'),
            'c_uuid' => Str::uuid(),
            'serial_no' => Str::random(40),
            'ip_address' => $this->faker->unique()->ipv4(),
            'fcm_token' => Str::random(40),
            'is_signed' => 1,
            'is_anonymous' => 0,
        ];
    }
}
