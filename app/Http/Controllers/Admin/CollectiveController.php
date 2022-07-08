<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Aplicant\ProcedingController;
use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\Proceding;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectiveController extends Controller
{

    public function __construct()
    {
        $this->middleware("can:secretaries.procedings.reject")->only("reject");
        $this->middleware("can:secretaries.procedings.dont_reject")->only("dont_reject");
        $this->middleware("can:secretaries.procedings.subsanar_expediente")->only("subsanar_expediente");
        $this->middleware("can:admin.procedings.procedingadmin")->only("procedingadmin");
    }

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

        $destino = $proceding->aplicant->user->profile->name . " " . $proceding->aplicant->user->profile->lastname;

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
            "rechazo"
        );

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
        $destino = $sub_proceding->aplicant->user->profile->name . " " . $sub_proceding->aplicant->user->profile->lastname;


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
            "subsanacion"
        );



        //SOLO SE EJECUTARÁ EN CASO EL EXPEDIENTE TENGA ALGUNA REFERENCIA
        // ESTO ESTÁ PENSADO SI ES OTRA VEZ QUE SE MANDA A SUBSANAR EL EXPEDIENTE ANTERIOR SE ARCHIVARÁ

        if ($sub_proceding->reference != "-") {

            //Buscara y actualizará a las referencias que tenga dicho expediente
            // Proceding::select()
            // ->where("reference",$proceding->reference)
            // ->update([
            //     "status" => "4"
            // ]);

            //Actualizará al expediente original
            $proceding = Proceding::where("code", $sub_proceding->reference)->first();

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
                "archivamiento"
            );
        }



        return redirect()->route('secretaries.procedings.index')
            ->with(['mensaje' => 'Se solicitó subsanación correctamente (Si el expediente tenia referencia, este fue archivado automáticamente)', 'color' => 'warning']);
    }

    public function graficos()
    {
        //----------------------------------**ENVIADOS**-----------------------------------------------------
        $proceding_enero = Proceding::where("created_at", ">=",  date('Y') . "-01-01")->where("created_at", "<=", date('Y') . "-01-31")->count();
        $proceding_febrero = Proceding::where("created_at", ">=",  date('Y') . "-02-01")->where("created_at", "<=",  date('Y') . "-02-31")->count();
        $proceding_marzo = Proceding::where("created_at", ">=",  date('Y') . "-03-01")->where("created_at", "<=",  date('Y') . "-03-31")->count();
        $proceding_abril = Proceding::where("created_at", ">=",  date('Y') . "-04-01")->where("created_at", "<=",  date('Y') . "-04-31")->count();
        $proceding_mayo = Proceding::where("created_at", ">=",  date('Y') . "-05-01")->where("created_at", "<=",  date('Y') . "-05-31")->count();
        $proceding_junio = Proceding::where("created_at", ">=",  date('Y') . "-06-01")->where("created_at", "<=",  date('Y') . "-06-31")->count();
        $proceding_julio = Proceding::where("created_at", ">=",  date('Y') . "-07-01")->where("created_at", "<=",  date('Y') . "-07-31")->count();
        $proceding_agosto = Proceding::where("created_at", ">=",  date('Y') . "-08-01")->where("created_at", "<=",  date('Y') . "-08-31")->count();
        $proceding_septiembre = Proceding::where("created_at", ">=",  date('Y') . "-09-01")->where("created_at", "<=",  date('Y') . "-09-31")->count();
        $proceding_octubre = Proceding::where("created_at", ">=",  date('Y') . "-10-01")->where("created_at", "<=",  date('Y') . "-10-31")->count();
        $proceding_noviembre = Proceding::where("created_at", ">=",  date('Y') . "-11-01")->where("created_at", "<=",  date('Y') . "-11-31")->count();
        $proceding_diciembre = Proceding::where("created_at", ">=",  date('Y') . "-12-01")->where("created_at", "<=",  date('Y') . "-12-31")->count();
        //------------------------------------ARCHIVADOS-------------------------------------------
        $proceding_enero_a = Proceding::where("updated_at", ">=",  date('Y') . "-01-01")->where("updated_at", "<=", date('Y') . "-01-31")->where("status", "4")->count();
        $proceding_febrero_a = Proceding::where("updated_at", ">=",  date('Y') . "-02-01")->where("updated_at", "<=",  date('Y') . "-02-31")->where("status", "4")->count();
        $proceding_marzo_a = Proceding::where("updated_at", ">=",  date('Y') . "-03-01")->where("updated_at", "<=",  date('Y') . "-03-31")->where("status", "4")->count();
        $proceding_abril_a = Proceding::where("updated_at", ">=",  date('Y') . "-04-01")->where("updated_at", "<=",  date('Y') . "-04-31")->where("status", "4")->count();
        $proceding_mayo_a = Proceding::where("updated_at", ">=",  date('Y') . "-05-01")->where("updated_at", "<=",  date('Y') . "-05-31")->where("status", "4")->count();
        $proceding_junio_a = Proceding::where("updated_at", ">=",  date('Y') . "-06-01")->where("updated_at", "<=",  date('Y') . "-06-31")->where("status", "4")->count();
        $proceding_julio_a = Proceding::where("updated_at", ">=",  date('Y') . "-07-01")->where("updated_at", "<=",  date('Y') . "-07-31")->where("status", "4")->count();
        $proceding_agosto_a = Proceding::where("updated_at", ">=",  date('Y') . "-08-01")->where("updated_at", "<=",  date('Y') . "-08-31")->where("status", "4")->count();
        $proceding_septiembre_a = Proceding::where("updated_at", ">=",  date('Y') . "-09-01")->where("updated_at", "<=",  date('Y') . "-09-31")->where("status", "4")->count();
        $proceding_octubre_a = Proceding::where("updated_at", ">=",  date('Y') . "-10-01")->where("updated_at", "<=",  date('Y') . "-10-31")->where("status", "4")->count();
        $proceding_noviembre_a = Proceding::where("updated_at", ">=",  date('Y') . "-11-01")->where("updated_at", "<=",  date('Y') . "-11-31")->where("status", "4")->count();
        $proceding_diciembre_a = Proceding::where("updated_at", ">=",  date('Y') . "-12-01")->where("updated_at", "<=",  date('Y') . "-12-31")->where("status", "4")->count();



        $usa1_r1 = Quiz::select('usa1')->where('usa1', '1')->count();
        $usa1_r2 = Quiz::select('usa1')->where('usa1', '2')->count();
        $usa1_r3 = Quiz::select('usa1')->where('usa1', '3')->count();
        $usa1_r4 = Quiz::select('usa1')->where('usa1', '4')->count();
        $usa1_r5 = Quiz::select('usa1')->where('usa1', '5')->count();

        $usa2_r1 = Quiz::select('usa2')->where('usa2', '1')->count();
        $usa2_r2 = Quiz::select('usa2')->where('usa2', '2')->count();
        $usa2_r3 = Quiz::select('usa2')->where('usa2', '3')->count();
        $usa2_r4 = Quiz::select('usa2')->where('usa2', '4')->count();
        $usa2_r5 = Quiz::select('usa2')->where('usa2', '5')->count();

        $fun1_r1 = Quiz::select('fun1')->where('fun1', '1')->count();
        $fun1_r2 = Quiz::select('fun1')->where('fun1', '2')->count();
        $fun1_r3 = Quiz::select('fun1')->where('fun1', '3')->count();
        $fun1_r4 = Quiz::select('fun1')->where('fun1', '4')->count();
        $fun1_r5 = Quiz::select('fun1')->where('fun1', '5')->count();

        $fun2_r1 = Quiz::select('fun2')->where('fun2', '1')->count();
        $fun2_r2 = Quiz::select('fun2')->where('fun2', '2')->count();
        $fun2_r3 = Quiz::select('fun2')->where('fun2', '3')->count();
        $fun2_r4 = Quiz::select('fun2')->where('fun2', '4')->count();
        $fun2_r5 = Quiz::select('fun2')->where('fun2', '5')->count();

        $acc1_r1 = Quiz::select('acc1')->where('acc1', '1')->count();
        $acc1_r2 = Quiz::select('acc1')->where('acc1', '2')->count();
        $acc1_r3 = Quiz::select('acc1')->where('acc1', '3')->count();
        $acc1_r4 = Quiz::select('acc1')->where('acc1', '4')->count();
        $acc1_r5 = Quiz::select('acc1')->where('acc1', '5')->count();

        $acc2_r1 = Quiz::select('acc2')->where('acc2', '1')->count();
        $acc2_r2 = Quiz::select('acc2')->where('acc2', '2')->count();
        $acc2_r3 = Quiz::select('acc2')->where('acc2', '3')->count();
        $acc2_r4 = Quiz::select('acc2')->where('acc2', '4')->count();
        $acc2_r5 = Quiz::select('acc2')->where('acc2', '5')->count();





        $array = [
            "Enviados" => [
                $proceding_enero,
                $proceding_febrero,
                $proceding_marzo,
                $proceding_abril,
                $proceding_mayo,
                $proceding_junio,
                $proceding_julio,
                $proceding_agosto,
                $proceding_septiembre,
                $proceding_octubre,
                $proceding_noviembre,
                $proceding_diciembre
            ],
            "Archivados" => [
                $proceding_enero_a,
                $proceding_febrero_a,
                $proceding_marzo_a,
                $proceding_abril_a,
                $proceding_mayo_a,
                $proceding_junio_a,
                $proceding_julio_a,
                $proceding_agosto_a,
                $proceding_septiembre_a,
                $proceding_octubre_a,
                $proceding_noviembre_a,
                $proceding_diciembre_a
            ],

            "usa1" => [
                $usa1_r1,
                $usa1_r2,
                $usa1_r3,
                $usa1_r4,
                $usa1_r5,
            ],
            "usa2" => [
                $usa2_r1,
                $usa2_r2,
                $usa2_r3,
                $usa2_r4,
                $usa2_r5,
            ],
            "fun1" => [
                $fun1_r1,
                $fun1_r2,
                $fun1_r3,
                $fun1_r4,
                $fun1_r5,
            ],
            "fun2" => [
                $fun2_r1,
                $fun2_r2,
                $fun2_r3,
                $fun2_r4,
                $fun2_r5,
            ],
            "acc1" => [
                $acc1_r1,
                $acc1_r2,
                $acc1_r3,
                $acc1_r4,
                $acc1_r5,
            ],
            "acc2" => [
                $acc2_r1,
                $acc2_r2,
                $acc2_r3,
                $acc2_r4,
                $acc2_r5,
            ],
        ];

        // return $array;
        // die();
        return response()->json([$array]);
    }


    public function procedingadmin()
    {

        $procedings = Proceding::select()->where("status", "4")->orWhere('status', '5')->get();
        $offices = Office::all();
        // return $documentos_archivados;
        // die();
        return view("admin.allprocedings.index", compact('procedings'));
    }
}
