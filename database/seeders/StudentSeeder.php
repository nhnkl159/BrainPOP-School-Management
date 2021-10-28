<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Seed the students database.
     *
     * @return void
     */
    public function run()
    {
        Student::factory(10)->create();
    }
}
