<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Seed the teachers database.
     *
     * @return void
     */
    public function run()
    {
        Teacher::factory(10)->create();
    }
}
