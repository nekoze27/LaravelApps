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
        Schema::create('diary_food_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diary_entry_id');
            $table->unsignedBigInteger('food_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('diary_entry_id')->references('id')->on('diary_entries')->onDelete('cascade');
            $table->foreign('food_id')->references('id')->on('food')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_food_items');
    }
};
