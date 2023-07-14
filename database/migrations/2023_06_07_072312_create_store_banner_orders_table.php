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
        Schema::create('store_banner_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained('merchants');
            $table->foreignId('store_id')->constrained('merchant_stores');
            $table->string('from_date');
            $table->string('to_date');
            $table->string('image');
            $table->integer('reach_no');
            $table->float('price_no');
            $table->string('description');
            $table->foreignId('status_id')->constrained('store_banner_order_statuses');
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
        Schema::dropIfExists('store_banner_orders');
    }
};
