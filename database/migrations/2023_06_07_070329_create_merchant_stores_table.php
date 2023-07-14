<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained('merchants');
            $table->string('store_name');
            $table->string('about_store');
            $table->string('profile_pic');
            $table->string('business_license');
            $table->string('appear_level');
            $table->string('phone');
            $table->string('business_phone');
            $table->string('whatsapp_phone');
            $table->string('business_email');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('general_discount');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('primary_store_language')->constrained('languages');
            $table->foreignId('second_store_language')->constrained('languages');
            $table->string('store_description');
            $table->string('lat');
            $table->string('long');
            $table->foreignId('status_id')->constrained('merchant_store_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_stores');
    }
};
