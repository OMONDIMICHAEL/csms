<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $subjects = [
          'Biology', 'Chemistry', 'Physics', 'Kiswahili', 'English', 
          'Mathematics', 'CRE', 'History', 'Geography', 'Agriculture', 'Business Studies'
      ];

      foreach ($subjects as $subject) {
          Subject::firstOrCreate(['name' => $subject]);
      }
    }
}
