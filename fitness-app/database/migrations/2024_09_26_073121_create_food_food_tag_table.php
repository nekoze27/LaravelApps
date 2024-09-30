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
        Schema::create('food_food_tag', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('food_tag_id');

            $table->foreign('food_id')->references('id')->on('food')->onDelete('cascade');
            $table->foreign('food_tag_id')->references('id')->on('food_tags')->onDelete('cascade');

            $table->unique(['food_id', 'food_tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_food_tag');
    }
};
