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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('dob');
            $table->string('gender');
            $table->foreignId('business_sector_id')->constrained('business_sectors');
            $table->foreignId('educational_status_id')->constrained('educational_statuses');
            $table->foreignId('nationality_id')->constrained('countries');
            $table->foreignId('resident_country')->constrained('countries');
            $table->foreignId('fav_lang')->constrained('languages');
            $table->foreignId('sec_fav_lang')->constrained('languages');
            $table->string('profile_pic');
            $table->boolean('is_active')->default(0);
            $table->string('otp')->nullable();
            $table->string('otp_expired')->nullable();
            $table->string('last_login')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
