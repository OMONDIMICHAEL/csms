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
        Schema::create('food_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('quantity'); // In KG, Litre, or Units
            $table->string('unit'); // KG, Litre, Pack, etc.
            $table->integer('threshold')->default(10); // Minimum level before alert
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_stocks');
    }
};
