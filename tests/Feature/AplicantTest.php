<?php

namespace Tests\Feature;

use App\Models\Aplicant;
use App\Models\District;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class AplicantTest extends TestCase
{
    //importante colocar -- php artisan config:clear
    use RefreshDatabase;

    /** @test */
    public function test_a_aplicant_has_many_proceding()
    {
        $aplicant = new  Aplicant();
        $this->assertInstanceOf(Collection::class, $aplicant->procedings);
    }

    //CRUD DE SOLICITANTE

    // CREAR SOLICITANTE
    /** @test */
    public function test_crear_usuario_solcitante(){
        $this->withoutExceptionHandling();
        ///======== autenticación
        $this->ejecutarRoles();

        $date = new DateTime("2001-01-01");

        $response = $this->post('/admin/aplicants',[
            "name" =>"José",
            "email" =>  "jose@gmail.com",
            "password" => "password",
            "lastname" =>  'Gonzales Mendoza',
            "type_document_id" => 1,
            "document_number" => "98888877",
            "date_nac" => $date,
            "gender" => 'm',
            "address" => 'av. 123',
            "district_id" =>1,
            "phone" => "988776665"
        ]);


        $solicitante = Aplicant::first();
        $this->assertEquals($solicitante->name,"José");



    }












    //creación deroles y permisos
    public function ejecutarRoles(){
        $admin = Role::create(["name"=>"admin"]);
        $secretario = Role::create(["name"=>"secretario"]);
        $solicitante = Role::create(["name"=>"solicitante"]);
         //Asiganación de permisos admin y secretarios

         Permission::create(["name"=>"admin.index", "description"=>"ver usuarios"])->syncRoles([$admin,$secretario]);

         Permission::create(["name"=>"admin.users.index","description"=>"ver usuarios"])->syncRoles([$admin,$secretario]);
         Permission::create(["name"=>"admin.users.show","description"=>"detallar usuarios"])->syncRoles([$admin,$secretario]);
         Permission::create(["name"=>"admin.users.create","description"=>"crear usuarios"])->syncRoles([$admin]);
         Permission::create(["name"=>"admin.users.edit","description"=>"editar usuarios"])->syncRoles([$admin]);
         Permission::create(["name"=>"admin.users.destroy","description"=>"eliminar usuarios"])->syncRoles([$admin]);

         Permission::create(["name"=>"admin.secretaries.index","description"=>"ver secretarios"])->syncRoles([$admin,$secretario]);
         Permission::create(["name"=>"admin.secretaries.create","description"=>"crear secretarios"])->syncRoles([$admin]);
         Permission::create(["name"=>"admin.secretaries.edit","description"=>"editar secretarios"])->syncRoles([$admin]);
         Permission::create(["name"=>"admin.secretaries.destroy","description"=>"eliminar secretarios"])->syncRoles([$admin]);

         Permission::create(["name"=>"admin.aplicants.index","description"=>"ver solicitantes"])->syncRoles([$admin,$secretario]);
         Permission::create(["name"=>"admin.aplicants.create","description"=>"crear solicitantes"])->syncRoles([$admin]);
         Permission::create(["name"=>"admin.aplicants.destroy","description"=>"eliminar solicitantes"])->syncRoles([$admin]);


         Permission::create(["name"=>"admin.typedocuments.index","description"=>"ver tipos de documentos"])->syncRoles([$admin,$secretario]);
         Permission::create(["name"=>"admin.typedocuments.create","description"=>"crear tipos de documentos"])->syncRoles([$admin]);
         Permission::create(["name"=>"admin.typedocuments.edit","description"=>"editar tipos de documentos"])->syncRoles([$admin]);
         Permission::create(["name"=>"admin.typedocuments.destroy","description"=>"eliminar tipos de documentos"])->syncRoles([$admin]);

         Permission::create(["name"=>"admin.offices.index","description"=>"ver oficinas"])->syncRoles([$admin,$secretario]);
         Permission::create(["name"=>"admin.offices.create","description"=>"crear oficinas"])->syncRoles([$admin]);
         Permission::create(["name"=>"admin.offices.edit","description"=>"editar oficinas"])->syncRoles([$admin]);
         Permission::create(["name"=>"admin.offices.destroy","description"=>"eliminar oficinas"])->syncRoles([$admin]);

         Permission::create(["name"=>"secretaries.procedings.destroy","description"=>"eliminar expedientes"])->syncRoles([$admin]); //eliminar expediente

         Permission::create(["name"=>"admin.typeprocedings.index","description"=>"ver tipos de expedientes"])->syncRoles([$admin,$secretario]);
         Permission::create(["name"=>"admin.typeprocedings.create","description"=>"crear tipos de expedientes"])->syncRoles([$admin]);
         Permission::create(["name"=>"admin.typeprocedings.edit","description"=>"editar tipos de expedientes"])->syncRoles([$admin]);
         Permission::create(["name"=>"admin.typeprocedings.destroy","description"=>"eliminar tipos de expedientes"])->syncRoles([$admin]);

         Permission::create(["name"=>"secretaries.procedings.index","description"=>"ver tus expedientes como secretario"])->syncRoles([$secretario]);
         Permission::create(["name"=>"secretaries.procedings.store","description"=>"responder expedientes"])->syncRoles([$secretario]); // notificacion final
         Permission::create(["name"=>"secretaries.procedings.show","description"=>"derivar expedientes a otras areas"])->syncRoles([$secretario]); //derivacion

         Permission::create(["name"=>"secretaries.archivate.procedings.index","description"=>"ver expedientes archivados"])->syncRoles([$secretario]); //expedientes archivados
         Permission::create(["name"=>"secretaries.archivate.procedings.destroy","description"=>"desarchivar expedientes"])->syncRoles([$secretario]); //expedientes archivados

         Permission::create(["name"=>"secretaries.procedings.reject","description"=>"rechazar expedientes"])->syncRoles([$secretario]); //expedientes rechazados
         Permission::create(["name"=>"secretaries.procedings.dont_reject","description"=>"aprobar expedientes"])->syncRoles([$secretario]); //expedientes aprobados
         Permission::create(["name"=>"secretaries.procedings.subsanar_expediente","description"=>"solicitar subsanacion de expedientes"])->syncRoles([$secretario]); //expedientes subsanacion
         Permission::create(["name"=>"admin.procedings.procedingadmin","description"=>"ver expedientes (admin) (archivados y rechazados)"])->syncRoles([$admin]); //expedientes subsanacion
        // creación de usuario

        $userAdmin = User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("jcNZHVrK3kvFEFGP7lu+zpr+")
        ]);
        // sincronizión de roles
        $userAdmin->syncRoles(["admin"]);
        // sesión para el usuario
        $response = $this->actingAs($userAdmin)->withSession(['banned' => true])->get('/');
    }
}
