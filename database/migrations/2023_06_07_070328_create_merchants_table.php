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
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('family_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('dob');
            $table->string('national_id');
            $table->string('profile_pic');
            $table->boolean('is_active')->default(0);
            $table->string('active_date')->nullable();
            $table->string('otp')->nullable();
            $table->string('otp_expired')->nullable();
            $table->string('last_login')->nullable();
            $table->foreignId('warning_card_id')->constrained('merchant_warning_cards')->nullable();
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
        Schema::dropIfExists('merchants');
    }
};
