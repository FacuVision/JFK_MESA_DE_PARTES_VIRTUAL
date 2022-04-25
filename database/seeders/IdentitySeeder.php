<?php

namespace Database\Seeders;

use App\Models\Type_document;
use App\Models\Type_proceding;
use Illuminate\Database\Seeder;

class IdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Type_document::create(["name"=>"DNI"]);
        Type_document::create(["name"=>"Carnet de Extranjeria"]);
        Type_document::create(["name"=>"PTP"]);
        Type_document::create(["name"=>"Cedula de identidad"]);
        Type_document::create(["name"=>"Pasaporte"]);

        Type_proceding::factory(15)->create();
    }
}
