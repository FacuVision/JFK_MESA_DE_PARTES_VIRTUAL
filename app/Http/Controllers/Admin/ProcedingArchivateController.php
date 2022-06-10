<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Aplicant\ProcedingController;
use App\Http\Controllers\Controller;
use App\Models\Proceding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcedingArchivateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $documentos_archivados = Proceding::select()->where("status","4")->where("office_id",$user->secretary->office->id)->get();

        return view("secretaries.archivates.index", compact("documentos_archivados"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }



    public function destroy($proceding)
    {
        $user = Auth::user();
        $proceding = Proceding::findOrFail($proceding);

        $proceding->update([
            "status" => "7"
        ]);


        $procedingControllerIncident = new ProcedingController();
        $array_datos = $procedingControllerIncident->user_data();


        //EL REMITENTE ES EL SECRETARIO
        $oficina_remitente = $user->secretary->office->name;

        //EL DESTINO ES EL APLICANT
        $nombre_destinatario = $user->profile->name ." ". $user->profile->lastname;
        $procedingControllerIncident->crearIncidente(
            $array_datos["ip"],
            $array_datos["nav"],
            $array_datos["so"],
            $user,
            $oficina_remitente,
            $oficina_remitente,            //oficina del destinatario, (en este caso el usuario no pertenece a ninguna oficina)
            $nombre_destinatario,       //nombres y apellidos
            "Desarchivado",
            $proceding->id,
            "desarchivamiento");

        return redirect()-> route("secretaries.archivate.procedings.index")->with(['mensaje' => 'Expediente desarchivado correctamente', 'color' => 'secondary']);
    }
}
