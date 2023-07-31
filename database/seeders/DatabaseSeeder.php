<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Customer::factory(2000)->create();
        // \App\Models\CustomerCity::factory(2000)->create();
        // \App\Models\CustomerState::factory(2000)->create();
        // \App\Models\CustomerCountry::factory(2000)->create();
        // \App\Models\CustomerFavCategory::factory(2000)->create();
        // \App\Models\CustomerFavStore::factory(2000)->create();
        // \App\Models\BannerCityOrder::factory(2000)->create();
        // \App\Models\BannerCountryOrder::factory(2000)->create();
        // \App\Models\BannerStateOrder::factory(2000)->create();
        // \App\Models\StoreBannerOrder::factory(2000)->create();
        // \App\Models\Merchant::factory(2000)->create();
        // \App\Models\MerchantStore::factory(1000)->create();
        // \App\Models\StoreCity::factory(1000)->create();
        // \App\Models\StoreState::factory(1000)->create();
        // \App\Models\StoreCountry::factory(1000)->create();
        // \App\Models\StoreRate::factory(1000)->create();
        // \App\Models\Product::factory(1000)->create();
        // \App\Models\ProductImage::factory(1000)->create();
        // \App\Models\MerchantOffer::factory(1000)->create();
        // \App\Models\StoreBanner::factory(1000)->create();

        // \App\Models\MerchantNotificationOrder::factory(2000)->create();
        // \App\Models\NotificationCityOrder::factory(2000)->create();
        // \App\Models\NotificationCountryOrder::factory(2000)->create();
        // \App\Models\NotificationStateOrder::factory(2000)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserTypeSeeder::class);
        $this->call(UserSeeder::class);
    }
}
