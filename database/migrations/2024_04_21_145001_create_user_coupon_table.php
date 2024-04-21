<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_coupon', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coupon_id');
            $table->timestamps();
        
            $table->primary(['user_id', 'coupon_id']);
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');

            $table->primary(['user_id', 'coupon_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_coupon');
    }
};
