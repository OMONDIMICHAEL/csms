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
        Schema::create('communications', function (Blueprint $table) {
            $table->id();$table->string('title');
            $table->text('message');
            $table->enum('type', ['notice', 'circular', 'meeting']);
            $table->dateTime('scheduled_at')->nullable(); // For meeting schedules
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade'); // Admin who posted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communications');
    }
};
