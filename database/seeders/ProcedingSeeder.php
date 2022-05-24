<?php

namespace Database\Seeders;

use App\Models\Proceding;
use Illuminate\Database\Seeder;

class ProcedingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proceding::factory(10)->create();
    }
}
