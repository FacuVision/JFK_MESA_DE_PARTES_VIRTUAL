<?php

namespace Tests\Feature;

use App\Models\Type_proceding;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Tests\Feature\TypeDocumentTest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class TypeProcedingTest extends TestCase
{
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
    //importante colocar -- php artisan config:clear
    use RefreshDatabase;
    /**@test */
    public function test_a_type_proceding_has_many_procedings()
    {
        $typeProceding = new  Type_proceding();
        $this->assertInstanceOf(Collection::class, $typeProceding->procedings);
    }
    
    //CREACIÓN DE TIPO DE PROCEDIMIENTO (SOLICITUD)
    /** @test */
    public function test_created_type_proceding_success(){
        $this->withoutExceptionHandling();
        ///======== AUTENTICACIÓN
        $this->ejecutarRoles();

        //== HTTP

        $response = $this->post('/admin/typeprocedings',[
            'name'=>'EMISION FICHA DE INSCRIPCION',
            'description'=>'La ficha de inscripcion es el documento que acredi...',
            'type'=>'system',
        ]);

        $typroceding=Type_proceding::first();
        $this->assertEquals($typroceding->name,"EMISION FICHA DE INSCRIPCION");
        $this->assertEquals($typroceding->description,"La ficha de inscripcion es el documento que acredi...");
        $this->assertEquals($typroceding->type,"system");
        // $response->assertoK();
    
        $response->assertRedirect(route('admin.typeprocedings.create'));
    }
    
    //LISTADO DE TIPO DE PROCEDIMIENTO (SOLICITUD)
    /** @test */
    public function test_type_proceding_can_be_retrieved(){
        $this->withoutExceptionHandling();
        ///======== Autenticación
        $this->ejecutarRoles();
         //datos de prueba
        Type_proceding::factory(10)->create();
        // metodo HTTP
        $response=$this->get('/admin/typeprocedings');
        $response->assertOk();
        $typedoc = Type_proceding::all();
        //Compara valores en la vista
        $response->assertViewIs('admin.typeprocedings.index');
        $response->assertViewHas('tipoexpedientes',$typedoc);

    }

    // MODIFICACIÓN DE TIPO DE EXPEDIENTES
    /** @test */
    public function test_type_proceding_can_be_updated(){
        $this->withoutExceptionHandling();
        ///======== AUTENTICACIÓN
        $this->ejecutarRoles();
        //datos de prueba
        $tipoexpediente = Type_proceding::factory(1)->create();
        // Método HTTP
        $response = $this->put("/admin/typeprocedings/{$tipoexpediente[0]->id}",[
            'name'=>'SOLICITUD PARA IR AL HOSPITAL',
            'description'=>'El docuemnto es válido si se presenta un certificado de salud',
            'type'=>'system',
        ]);

        $tipoexp = Type_proceding::findOrFail($tipoexpediente[0]->id);
        //compración de valores
        $this->assertEquals($tipoexp->name,'SOLICITUD PARA IR AL HOSPITAL');
        $this->assertEquals($tipoexp->description,'El docuemnto es válido si se presenta un certificado de salud');
        $this->assertEquals($tipoexp->type,'system');
        //Redirección
        $response->assertRedirect(route("admin.typeprocedings.edit",$tipoexp->id));
    
    }

    //ELIMINAR EL TIPO DE EXPEDIENTE
    public function test_type_proceding_can_be_deleted(){
    $this->withoutExceptionHandling();
    ///======== AUTENTICACIÓN
    $this->ejecutarRoles();

    //Datos de prueba
    $typeexp = Type_proceding::factory(1)->create();

    $response = $this->delete("/admin/typeprocedings/{$typeexp[0]->id}");

    //Validar que en la base de datos esté vacío
    $this->assertCount(0,Type_proceding::all());

    //Redirección al index
    $response->assertRedirect(route('admin.typeprocedings.index'));
    }


}
