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
        Schema::table('merchants', function (Blueprint $table) {
            $table->boolean('block_type')->default(0);
            $table->string('block_temporary_reason')->nullable();
            $table->timestamp('active_time')->nullable();
            $table->unsignedBigInteger('block_by')->nullable();
            $table->foreign('block_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('warning_id')->nullable();
            $table->foreign('warning_id')->references('id')->on('merchant_warning_cards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchants', function (Blueprint $table) {
            //
        });
    }
};
