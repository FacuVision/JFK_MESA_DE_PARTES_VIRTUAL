<?php

namespace Database\Seeders;

use App\Models\Departament;
use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departament = Departament::factory(24)->create();
        $province = Province::factory(15)->create();
        $district = District::factory(10)->create();

    }
}
