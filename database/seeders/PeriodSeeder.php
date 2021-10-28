<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Period;

class PeriodSeeder extends Seeder
{
    /**
     * Seed the periods database.
     *
     * @return void
     */
    public function run()
    {
        Period::factory(10)->create();
    }
}
