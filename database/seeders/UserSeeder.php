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
        $admin = User::create([
            "name" => "emma",
            "email" => "emma@gmail.com",
            "password" => bcrypt("emmanuel@gmail.com")
        ]);

        $date = new DateTime("2001-01-01");

        $admin->profile()->create(
            [
                "name" => "Emmanuel",
                "lastname" => "Garayar",
                "date_nac" => $date,
                "gender" => "m",
                "address" => "mi casa",
                "phone" => "955633251",
                "document_number" => "74741985",
                "district_id" => 1,
                "user_id" => 1,
                "type_document_id" => 1
            ]
        );


        //********************************************** */

        $users = User::factory(5)->create();

        foreach ($users as $user) {

            //LOS MODELOS PUEDEN LLAMAR A LAS FACTORIES, PERO LOS OBJETOS POR ALGUNA RAZON NO PUEDEN


            //CREAMOS LOS 5 PERFILES
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

        $users = User::factory(5)->create();

        foreach ($users as $user) {


            //CREAMOS LOS 5 PERFILES
            Profile::factory()->create([
                "name" => $user->name,
                "user_id" => $user->id,
                "district_id" => District::all()->random(),
                "type_document_id" => Type_document::all()->random(),
            ]);

            //ASOCIAMOS EL USUARIO AL APLICANT
            Secretary::factory()->create([
                "user_id" => $user->id,
                "office_id" => Office::all()->random()->id
            ]);

            //ASIGNAMOS LOS ROLES
            //COMMING SOON
        }



    }
}
