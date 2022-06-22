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
        Office::create([
            "name"=> "Gerencia General",
            "description" => "***"
        ]);

        Office::create([
            "name"=> "Secretaria General",
            "description" => "***"
        ]);

        Office::create([
            "name"=> "Educacion",
            "description" => "***"
        ]);

        Office::create([
            "name"=> "Finanzas",
            "description" => "****"
        ]);

        Office::create([
            "name"=> "Atencion al cliente",
            "description" => "****"
        ]);

    }
}
