<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Office::factory(1)->create([
            "name"=> "Gerencia General",
            "description" => "***"
        ]);

        Office::factory(1)->create([
            "name"=> "Secretaria General",
            "description" => "***"
        ]);

        Office::factory(1)->create([
            "name"=> "Educacion",
            "description" => "***"
        ]);

        Office::factory(1)->create([
            "name"=> "Finanzas",
            "description" => "****"
        ]);

        Office::factory(1)->create([
            "name"=> "Atencion al cliente",
            "description" => "****"
        ]);

    }
}
