<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Aplicant\ProcedingController;
use App\Http\Controllers\Controller;
use App\Models\Proceding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectiveController extends Controller
{
    //ESTE METODO SIRVE PARA RECHAZAR UN EXPEDIENTE DEL LADO DEL SECRETARIO
    public function reject(Proceding $proceding)
    {
        $user = Auth::user();

        $proceding->update([
            'status' => '5',
        ]);

        //registramos en los incidentes

        $procedingControllerIncident = new ProcedingController();
        $array_datos = $procedingControllerIncident->user_data();

        $oficina_remitente = $user->secretary->office->name;

        $destino = $proceding->aplicant->user->profile->name." ".$proceding->aplicant->user->profile->lastname;

        $procedingControllerIncident->crearIncidente(
            $array_datos["ip"],
            $array_datos["nav"],
            $array_datos["so"],
            $user,
            $oficina_remitente,
            "-",            //oficina del destinatario, (en este caso el usuario no pertenece a ninguna oficina)
            $destino,       //nombres y apellidos
            "Rechazado",
            $proceding->id,
            "rechazo");

        return redirect()->route('secretaries.procedings.index')->with(['mensaje' => 'Expediente rechazado correctamente', 'color' => 'danger']);
    }


    //ESTE METODO SIRVE PARA APROBAR UN EXPEDIENTE RECHAZADO DEL LADO DEL SECRETARIO
    public function dont_reject(Proceding $proceding)
    {
        //$user = Auth::user();


        $proceding->update([
            'status' => '1',
        ]);

        //registramos en los incidentes

        // $procedingControllerIncident = new ProcedingController();
        // $array_datos = $procedingControllerIncident->user_data();

        // $oficina_remitente = $user->secretary->office->name;

        // $destino = $proceding->aplicant->user->profile->name." ".$proceding->aplicant->user->profile->lastname;

        // $procedingControllerIncident->crearIncidente(
        //     $array_datos["ip"],
        //     $array_datos["nav"],
        //     $array_datos["so"],
        //     $user,
        //     $oficina_remitente,
        //     "-",            //oficina del destinatario, (en este caso el usuario no pertenece a ninguna oficina)
        //     $destino,       //nombres y apellidos
        //     "Enviado",
        //     $proceding->id,
        //     "envio");

        return redirect()->route('secretaries.procedings.index')->with(['mensaje' => 'Expediente aprobado correctamente', 'color' => 'success']);
    }







    //ESTE METODO SIRVE PARA SOLICITAR SUBSANACION POR PARTE DEL SECRETARIO
    public function subsanar_expediente(Proceding $sub_proceding, Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'titulo' => 'required|string',
            'contenido' => 'required|string'
        ]);

        //ACTUALIZAMOS EL ESTADO DEL EXPEDIENTE A SUBSANAR
        $sub_proceding->update([
            "status" => "3"
        ]);

        //Enviamos la notificacion de subsanacion
        $sub_proceding->answers()->create([
            "title" => $request->titulo,
            "content" => $request->contenido,
            "read_status" => "0",
            "user_id" => $user->id,
            "proceding_id" => $sub_proceding->id,
            "answer_type" => "1"
        ]);


        $procedingControllerIncident = new ProcedingController();
        $array_datos = $procedingControllerIncident->user_data();

        $oficina_remitente = $user->secretary->office->name;
        $destino = $sub_proceding->aplicant->user->profile->name." ".$sub_proceding->aplicant->user->profile->lastname;


         //registramos en los incidentes
         $procedingControllerIncident->crearIncidente(
            $array_datos["ip"],
            $array_datos["nav"],
            $array_datos["so"],
            $user,
            $oficina_remitente,
            "-",            //oficina del destinatario, (en este caso el usuario no pertenece a ninguna oficina)
            $destino,       //nombres y apellidos
            "Por subsanar",
            $sub_proceding->id,
            "subsanacion");



        //SOLO SE EJECUTARÁ EN CASO EL EXPEDIENTE TENGA ALGUNA REFERENCIA
        // ESTO ESTÁ PENSADO SI ES OTRA VEZ QUE SE MANDA A SUBSANAR EL EXPEDIENTE ANTERIOR SE ARCHIVARÁ

          if($sub_proceding->reference != "-"){

            //Buscara y actualizará a las referencias que tenga dicho expediente
            // Proceding::select()
            // ->where("reference",$proceding->reference)
            // ->update([
            //     "status" => "4"
            // ]);

            //Actualizará al expediente original
            $proceding = Proceding::where("code",$sub_proceding->reference)->first();

            $proceding->update([
                "status" => "4"
            ]);

            $procedingControllerIncident->crearIncidente(
                $array_datos["ip"],
                $array_datos["nav"],
                $array_datos["so"],
                $user,
                $oficina_remitente,
                "-",            //oficina del destinatario, (en este caso el usuario no pertenece a ninguna oficina)
                $destino,       //nombres y apellidos
                "Archivado",
                $proceding->id,
                "archivamiento");
        }



        return redirect()->route('secretaries.procedings.index')
        ->with(['mensaje' => 'Se solicitó subsanación correctamente (sI el expediente tenia referencia, este fue archivado automáticamente)', 'color' => 'warning']);

    }

    // public function graficos()
    // {
    //     echo "aea";
    // }

}
