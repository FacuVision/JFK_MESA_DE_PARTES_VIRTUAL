<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proceding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectiveController extends Controller
{
    //ESTE METODO SIRVE PARA RECHAZAR UN EXPEDIENTE DEL LADO DEL SECRETARIO
    public function reject(Proceding $proceding)
    {
        $proceding->update([
            'status' => '5',
        ]);
        return redirect()->route('secretary.procedings.index')->with(['mensaje' => 'Expediente rechazado correctamente', 'color' => 'danger']);
    }

    //ESTE METODO SIRVE PARA APROBAR UN EXPEDIENTE RECHAZADO DEL LADO DEL SECRETARIO
    public function dont_reject(Proceding $proceding)
    {
        $proceding->update([
            'status' => '1',
        ]);
        return redirect()->route('secretary.procedings.index')->with(['mensaje' => 'Expediente aprobado correctamente', 'color' => 'success']);
    }

    //ESTE METODO SIRVE PARA SOLICITAR SUBSANACION POR PARTE DEL SECRETARIO
    public function subsanar_expediente(Proceding $proceding, Request $request)
    {

        $proceding->update([
            "status" => "3"
        ]);

        $proceding->answers()->create([
            "title" => $request->titulo,
            "content" => $request->contenido,
            "read_status" => "0",
            "user_id" => Auth::user()->id,
            "proceding_id" => $proceding->id
        ]);


        //SOLO SE EJECUTARÁ EN CASO EL EXPEDIENTE TENGA ALGUNA REFERENCIA
          if($proceding->reference != "-"){
            //Buscara y actualizará a las referencias que tenga dicho expediente
            // Proceding::select()
            // ->where("reference",$proceding->reference)
            // ->update([
            //     "status" => "4"
            // ]);

            //Actualizará al expediente original
            Proceding::select()
            ->where("code",$proceding->reference)
            ->update([
                "status" => "4"
            ]);
        }

        return redirect()->route('secretary.procedings.index')
        ->with(['mensaje' => 'Se solicitó subsanación correctamente (el expediente anterior fue archivado automáticamente)', 'color' => 'warning']);

    }



}
