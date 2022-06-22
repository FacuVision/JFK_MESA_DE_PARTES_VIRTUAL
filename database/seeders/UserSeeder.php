<?php

namespace Database\Seeders;

use App\Models\Aplicant;
use App\Models\District;
use Spatie\Permission\Models\Role;
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
        $admin = User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("admin@gmail.com")
        ]);

        $admin->syncRoles(["admin"]);


        $date = new DateTime("2001-01-01");

        $admin->profile()->create(
            [
                "name" => "Admin",
                "lastname" => "Apellido admin",
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

        // //ASOCIAMOS EL USUARIO AL APLICANT
        // Secretary::factory()->create([
        //     "user_id" => $admin->id,
        //     "office_id" => 1,
        // ]);




        $secretario = User::create([
            "name" => "Secretario",
            "email" => "secretario@gmail.com",
            "password" => bcrypt("secretario@gmail.com")
        ]);


        $secretario->assignRole("secretario");

        $date = new DateTime("1990-01-01");

        $secretario->profile()->create(
            [
                "name" => "Secretario",
                "lastname" => "Apellido Secretario",
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
        Secretary::create([
            "user_id" => $secretario->id,
            "office_id" => 2,
        ]);




        //********************************************** */

        // $users = User::factory(20)->create();


        // foreach ($users as $user) {

        //     $user->assignRole("solicitante");

        //     //LOS MODELOS PUEDEN LLAMAR A LAS FACTORIES, PERO LOS OBJETOS POR ALGUNA RAZON NO PUEDEN

        //     //CREAMOS LOS  PERFILES
        //     Profile::factory()->create([
        //         "name" => $user->name,
        //         "user_id" => $user->id,
        //         "district_id" => District::all()->random(),
        //         "type_document_id" => Type_document::all()->random(),
        //     ]);

        //     //ASOCIAMOS EL USUARIO AL APLICANT
        //     Aplicant::factory()->create([
        //         "user_id" => $user->id,
        //     ]);

        //     //ASIGNAMOS LOS ROLES
        //     //COMMING SOON
        // }

        //********************************************** */

        // $users = User::factory(3)->create();

        // $conteo = 3;
        // foreach ($users as $user) {

        //     $user->assignRole("secretario");

        //     //CREAMOS LOS 4 PERFILES
        //     Profile::factory()->create([
        //         "name" => $user->name,
        //         "user_id" => $user->id,
        //         "district_id" => District::all()->random(),
        //         "type_document_id" => Type_document::all()->random(),
        //     ]);

        //     //ASOCIAMOS EL USUARIO
        //     Secretary::factory()->create(
        //         ["user_id" => $user->id,"office_id" => $conteo]);

        //     //ASIGNAMOS LOS ROLES
        //     //COMMING SOON
        //     $conteo++;
        // }



    }
}
