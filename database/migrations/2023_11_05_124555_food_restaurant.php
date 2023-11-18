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
        Schema::create('food_restaurant',function (Blueprint $table){
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete()->cascadeOnDelete();
            $table->foreignId('food_tier_id')->constrained()->cascadeOnDelete()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
