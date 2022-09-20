<?php

namespace Tests\Feature;

use App\Models\Type_document;
use App\Models\User;
use Database\Factories\UserFactory;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TypeDocumentTest extends TestCase
{
    //importante colocar -- php artisan config:clear
    use RefreshDatabase;
     /**@test */
    public function test_a_type_document_has_many_profiles()
    {
        $typeDocument = new  Type_document();
        $this->assertInstanceOf(Collection::class, $typeDocument->profiles);
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

    //creación de un tipo de documento
    /** @test */
    public function test_createdTypeDocument_success(){
        $this->withoutExceptionHandling();
        ///======== creación de los roles
        $this->ejecutarRoles();

        ///========
        $response = $this->post('/admin/typedocuments',[
            'name'=>'DNI'
        ]);

        $typedoc=Type_document::first();
        $this->assertEquals($typedoc->name,"DNI");
        // $response->assertoK();

        $response->assertRedirect(route('admin.typedocuments.index'));
    }


    //LISTAR TIPOS DE DOCUMENTOS
    public function test_list_can_be_retrieved(){
        $this->withoutExceptionHandling();
        ///======== creación de los roles
        $this->ejecutarRoles();
        //datos de prueba
        Type_document::factory(10)->create();
        // metodo HTTP
        $response=$this->get('/admin/typedocuments');
        $response->assertOk();
        $typedoc = Type_document::all();

        //Compara valores en la vista
        $response->assertViewIs('admin.typedocuments.index');
        $response->assertViewHas('types',$typedoc);
    }

        //Ir al formulario de editar
    /** @test */
    public function test_project_can_be_retrivied(){
        $this->withoutExceptionHandling();
        ///======== AUTENTICACIÓN
        $this->ejecutarRoles();
        //Datos de prueba
        $typedoc = Type_document::factory(1)->create();

        $response = $this->get("/admin/typedocuments/{$typedoc[0]->id}");
        $response->assertOk();

        $project = Type_document::first();
        $response->assertViewIs('admin.typedocuments.show');
        $response->assertViewHas('typedocument', $project);
    }

        // Modificación de datos
    /** @test */
    public function test_type_document_can_be_updated(){
        $this->withoutExceptionHandling();
        ///======== AUTENTICACIÓN
        $this->ejecutarRoles();
        //datos de prueba
        $typedoc = Type_document::factory(1)->create();
        // Método HTTP
        $response = $this->put("/admin/typedocuments/{$typedoc[0]->id}",[
            'name' => 'Documento Test',
        ]);

        $typeDocument = Type_document::findOrFail($typedoc[0]->id);
        //compración de valores
        $this->assertEquals($typeDocument->name,'Documento Test');
        //Redirección
        $response->assertRedirect(route("admin.typedocuments.edit",$typeDocument));

    }

    //ELIMINAR TYPO DE DOCUMENTO
    /** @test */
    public function test_type_document_can_be_deleted(){
        $this->withoutExceptionHandling();
        ///======== AUTENTICACIÓN
        $this->ejecutarRoles();

        //Datos de prueba
        $typedoc = Type_document::factory(1)->create();

        $response = $this->delete("/admin/typedocuments/{$typedoc[0]->id}");

        //Validar que en la base de datos esté vacío
        $this->assertCount(0,Type_document::all());

        //Redirección al index
        $response->assertRedirect(route('admin.typedocuments.index'));
    }


    /**@test */
    public function test_interacting_with_the_session()
    {
        $response = $this->withSession(['banned' => false])->get('/');
        $response->assertOk();
    }

    public function test_an_action_that_requires_authentication()
    {
        User::factory(1)->create();
        $user = User::first();

        $response = $this->actingAs($user)->withSession(['banned' => false])->get('/');
        $response->assertOk();

    }

}
