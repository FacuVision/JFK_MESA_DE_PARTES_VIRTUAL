<?php

namespace Database\Seeders;

use App\Models\Aplicant;
use App\Models\District;
use App\Models\Office;
use App\Models\Profile;
use App\Models\Secretary;
use App\Models\Type_document;
use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $solicitante = User::create([
            "name" => "emma",
            "email" => "correoprueba@gmail.com",
            "password" => bcrypt("correoprueba@gmail.com")
        ]);

        $date = new DateTime("2001-01-01");

        $solicitante->profile()->create(
            [
                "name" => "Emmanuel",
                "lastname" => "Garayar",
                "date_nac" => $date,
                "gender" => "m",
                "address" => "Direccion",
                "phone" => "963852741",
                "document_number" => "96396312",
                "district_id" => 1,
                "user_id" => 1,
                "type_document_id" => 1,
            ]
        );


        //ASOCIAMOS EL USUARIO AL APLICANT
        Aplicant::factory()->create([
            "user_id" => $solicitante->id,
        ]);





        $secretario = User::create([
            "name" => "Sr. Secretario",
            "email" => "secretario@gmail.com",
            "password" => bcrypt("secretario@gmail.com")
        ]);

        $date = new DateTime("1990-01-01");

        $secretario->profile()->create(
            [
                "name" => "Secretario",
                "lastname" => "Apellido del secretario",
                "date_nac" => $date,
                "gender" => "m",
                "address" => "Direccion",
                "phone" => "963258474",
                "document_number" => "85236914",
                "district_id" => 1,
                "user_id" => 2,
                "type_document_id" => 1,
            ]
        );


        //ASOCIAMOS EL USUARIO AL APLICANT
        Secretary::factory()->create([
            "user_id" => $secretario->id,
            "office_id" => 1,
        ]);








        //********************************************** */

        $users = User::factory(40)->create();

        foreach ($users as $user) {

            //LOS MODELOS PUEDEN LLAMAR A LAS FACTORIES, PERO LOS OBJETOS POR ALGUNA RAZON NO PUEDEN


            //CREAMOS LOS  PERFILES
            Profile::factory()->create([
                "name" => $user->name,
                "user_id" => $user->id,
                "district_id" => District::all()->random(),
                "type_document_id" => Type_document::all()->random(),
            ]);

            //ASOCIAMOS EL USUARIO AL APLICANT
            Aplicant::factory()->create([
                "user_id" => $user->id,
            ]);

            //ASIGNAMOS LOS ROLES
            //COMMING SOON
        }

        //********************************************** */

        $users = User::factory(4)->create();

        $conteo = 2;
        foreach ($users as $user) {


            //CREAMOS LOS 4 PERFILES
            Profile::factory()->create([
                "name" => $user->name,
                "user_id" => $user->id,
                "district_id" => District::all()->random(),
                "type_document_id" => Type_document::all()->random(),
            ]);

            //ASOCIAMOS EL USUARIO
            Secretary::factory()->create(
                ["user_id" => $user->id,"office_id" => $conteo]);

            //ASIGNAMOS LOS ROLES
            //COMMING SOON
            $conteo++;
        }



    }
}
