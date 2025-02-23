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
    // public function assignments()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }
    public function assignments()
    {
      return $this->hasMany(Assignment::class, 'teacher_id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
    public function exams()
    {
      return $this->hasMany(Exam::class, 'teacher_id');
    }
    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id');
    }
};
