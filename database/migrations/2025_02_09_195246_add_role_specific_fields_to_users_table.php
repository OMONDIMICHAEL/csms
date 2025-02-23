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
        Schema::table('users', function (Blueprint $table) {
          // General fields for all users
          $table->string('phone_number')->nullable();
          $table->string('address')->nullable();

          // Admin-specific fields
          $table->string('admin_code')->nullable();

          // Teacher-specific fields
          $table->string('teacher_id')->nullable();
          $table->string('subject')->nullable();

          // Student-specific fields
          $table->string('student_id')->nullable();
          $table->string('class')->nullable();
          $table->string('parent_contact')->nullable();

          // Parent-specific fields
          $table->string('parent_id')->nullable();
          $table->integer('number_of_children')->nullable();

          // Security-specific fields
          $table->string('security_badge_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn([
              'phone_number', 'address',
              'admin_code',
              'teacher_id', 'subject',
              'student_id', 'class', 'parent_contact',
              'parent_id', 'number_of_children',
              'security_badge_number'
          ]);
        });
    }
};
