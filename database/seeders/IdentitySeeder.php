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

        Type_proceding::create(
            ["name"=>"EMISION FICHA DE INSCRIPCION",
            "description"=>"La ficha de inscripcion es el documento que acredita que el estudiante ha sido matriculado correctamente",
            "type"=>"system" ]);

        Type_proceding::create(
            ["name"=>"PRESENTACION DE DESCANSOS MEDICOS",
            "description"=>"El descanso medico acredita que el trabajador se encuentra en resposo por algun accidente o enfermedad, el cual se toma en cuenta en sus inasistencias",
            "type"=>"system" ]);

        Type_proceding::create(
            ["name"=>"AUTORIZACION DE PADRES A MENORES DE EDAD",
            "description"=>"Cuando un menor de edad requiere aprender a conducir, es necesario contar con el consentimiento de los padres de familia",
            "type"=>"system" ]);

        Type_proceding::create(
            ["name"=>"VERIFICACION DE EXAMEN MÉDICO",
            "description"=>"Es un requisito importante para que el estudiante pueda empezar a dar sus clases de manejo y se encuentre en las condiciones fisicas y mentales adecuadas",
            "type"=>"system" ]);

        Type_proceding::create(
            ["name"=>"HACER UN COMUNICADO",
            "description"=>"Se pueden redactar comunicados o mensajes a una oficina en especifico",
            "type"=>"system" ]);

        Type_proceding::create(
            ["name"=>"QUEJA O RECLAMO",
            "description"=>"Presenta una queja o reclamo de algun incidente ocurrido con nuestros servicios o colaboradores",
            "type"=>"system" ]);

        Type_proceding::create(
            ["name"=>"SOLICITUD EN GENERAL",
            "description"=>"Solicita o realiza algun pedido a nuestras oficinas",
            "type"=>"system" ]);

        Type_proceding::create(
            ["name"=>"CARTA DE RENUNCIA",
            "description"=>"Ya sea por termino de contrato, algun inconveniente o motivo alguno puedes presentar tu carta de renuncia a nuestras oficinas",
            "type"=>"system" ]);

        Type_proceding::create(
                ["name"=>"PERMISO PREVISIONAL (PARA CLASES DE MANEJO)",
                "description"=>"El permiso provisional para aprender a conducir habilita a una persona a manejar un vehículo en la vía pública por el período de 6 meses, acompañado siempre de un instructor (familiar, amigo o conocido) que cuente con un brevete hace más de 2 años.",
                "type"=>"system" ]);

        Type_proceding::create(
                ["name"=>"SOLICITUD DE ACTUALIZACION DE DATOS DE PERFIL)",
                "description"=>"Si quieres hacer alguna correccion de tu informacion brindada a la mesa de partes, puedes solicitarlo a las oficinas para que puedan hacer tu actualizacion correspondiente",
                "type"=>"system" ]);

                Type_proceding::create(
                    ["name"=>"SUBSANACION",
                    "description"=>"Documento que ha sido rechazado o necesita archivos adicionales",
                    "type"=>"system" ]);

        Type_proceding::create(
                    ["name"=>"OTROS",
                    "description"=>"El solicitante puede adjuntar otros archivos",
                    "type"=>"system" ]);

    }
}
