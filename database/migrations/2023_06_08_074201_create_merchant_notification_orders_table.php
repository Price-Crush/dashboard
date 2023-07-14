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
        Schema::create('merchant_notification_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained('merchants');
            $table->foreignId('store_id')->constrained('merchant_stores');
            $table->string('launch_date');
            $table->string('age_range');
            $table->string('gender');
            $table->foreignId('category_id')->constrained('categories');
            $table->integer('reach_no');
            $table->float('price');
            $table->string('notification_title_ar')->nullable();
            $table->string('notification_title_en')->nullable();
            $table->string('notification_title_tr')->nullable();
            $table->string('notification_details_ar')->nullable();
            $table->string('notification_details_en')->nullable();
            $table->string('notification_details_tr')->nullable();
            $table->foreignId('primary_language')->constrained('languages');
            $table->string('notification_link')->nullable();
            $table->foreignId('status_id')->constrained('merchant_notification_order_statuses');
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
        Schema::dropIfExists('merchant_notification_orders');
    }
};
