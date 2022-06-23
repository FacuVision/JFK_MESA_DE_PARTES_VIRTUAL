<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Aplicant\ProcedingController as AplicantProcedingController;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentSecretaryRequest;
use App\Models\Anotation;
use App\Models\Answer;
use App\Models\Office;
use App\Models\Proceding;
use App\Models\Secretary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProcedingController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:secretaries.procedings.index")->only("index");
        $this->middleware("can:secretaries.procedings.store")->only("store");
        $this->middleware("can:secretaries.procedings.show")->only("show", "update");
        $this->middleware("can:secretaries.procedings.destroy")->only("destroy");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $secretary = Secretary::findOrFail(Auth::id());
        $procedings = Proceding::select()->where("office_id", $secretary->office->id)->where("status", "<>", "4")->get();
        $offices = Office::all();



        return view('secretaries.procedings.index', compact('procedings', 'offices'));
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


    //función 2 | crear archivos
    public function crearArchivos($pdf1, $answer)
    {

        $year = date('Y');
        $user = Auth::user();

        //se cambia los puntos por '' vacío
        $cadena = str_replace('.', '', $user->name);
        //este nombre es para la carpeta que se creará
        $nomArchivo = preg_replace("/\s+/u", "", $cadena);

        if ($pdf1 != null) {
            //La funcion Strtr va a cambiar los espacios vacios por "_"

            $filename = $year . '-' . strtr($pdf1->getClientOriginalName(), " ", "_");

            $extension = $pdf1->extension();

            if ($extension == 'pdf') {
                // se crea una carpeta con el id del usuario
                //se coloca la ruta, el archivo en si y el nombre de archivo cambiado

                if (Storage::putFileAs('/public/answer/' . $user->id . '-' . $nomArchivo . '/', $pdf1, $filename)) {

                    $answer->documents()->create([
                        'type' => '0',
                        'url' => "public/answer/" . $user->id . '-' . $nomArchivo . '/' . $filename
                    ]);
                }
            }
        }
    }

    public function store(DocumentSecretaryRequest $request)
    {

        $user = Auth::user();
        $answer_pdf = $request->file('answer_pdf');


        $proceding = Proceding::findOrFail($request->procedingid);

        //CREAMOS LA RESPUESTA CORRESPONDIENTE

        $new_answer =  Answer::create([
            'title' => $request->title,
            'content' => $request->content,
            'read_status' => '0',
            'proceding_id' => $proceding->id,
            'user_id' => $user->id,
            "answer_type" => "0"
        ]);

        if ($request->file('answer_pdf')) {
            $this->crearArchivos($answer_pdf, $new_answer);
        }

        //SE ACTUALIZA A ARCHIVADO
        $proceding->update([
            'status' => '4',
        ]);

        //--------------------------CREACION DE INCIDENTES ---------------------
        $procedingControllerIncident = new AplicantProcedingController();
        $array_datos = $procedingControllerIncident->user_data();


        //EL REMITENTE ES EL SECRETARIO
        $oficina_remitente = $user->secretary->office->name;

        //EL DESTINO ES EL APLICANT
        $destino_aplicant = $proceding->aplicant->user->profile->name . " " . $proceding->aplicant->user->profile->lastname;

        $procedingControllerIncident->crearIncidente(
            $array_datos["ip"],
            $array_datos["nav"],
            $array_datos["so"],
            $user,
            $oficina_remitente,
            "-",            //oficina del destinatario, (en este caso el usuario no pertenece a ninguna oficina)
            $destino_aplicant,       //nombres y apellidos
            "Archivado",
            $proceding->id,
            "notificacion final"
        );
        //-----------------------------------------------------------

        //SOLO SE EJECUTARÁ EN CASO EL EXPEDIENTE TENGA ALGUNA REFERENCIA
        if ($proceding->reference != "-") {

            //Buscara y actualizará a las referencias que tenga dicho expediente
            $proceding2 = Proceding::where("code", $proceding->reference)->first();

            $proceding2->update([
                "status" => "4"
            ]);

            $procedingControllerIncident->crearIncidente(
                $array_datos["ip"],
                $array_datos["nav"],
                $array_datos["so"],
                $user,
                $oficina_remitente,
                "-",                        //oficina del destinatario, (en este caso el usuario no pertenece a ninguna oficina)
                $destino_aplicant,       //nombres y apellidos
                "Archivado",
                $proceding2->id,
                "archivamiento"
            );


            $new_answer =  Answer::create([
                'title' => "El documento fué archivado correctamente",
                'content' => "Este documento fue subsanado y posteriormente archivado, por favor revisar el ultimo expediente enviado con Codigo Nº " . $proceding->code,
                'read_status' => '0',
                'proceding_id' => $proceding2->id,
                'user_id' => $user->id,
                "answer_type" => "0"
            ]);

            //Actualizará al expediente original

            // Proceding::select()
            //     ->where("code", $proceding->reference)
            //     ->update([
            //         "status" => "4"
            // ]);

        }


        //$pro = Proceding::select()->where("reference",$proceding->reference)->get();
        // Incident::create([
        //     'office_remitent' => $proceding->office->name,
        //     'remitent' => Auth::email(),
        //     'office_destiny' => $proceding->office->name,
        //     'destiny' => Auth::email(),
        //     'status' => '',
        //     'proceding_id' => $proceding->id
        // ]);

        return redirect()->route('secretaries.procedings.index')->with(['mensaje' => 'Respuesta Enviada (El(los) expediente(s) fueron archivados automáticamente)', 'color' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proceding  $proceding
     * @return \Illuminate\Http\Response
     */
    public function show(Proceding $proceding)
    {
        $user = Auth::user();

        $proceding->update([
            'status' => '4'
        ]);

        //---------------registramos en los incidentes de archivamiento de expediente------------------------------------
        $procedingControllerIncident = new AplicantProcedingController();
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
            "Archivado",
            $proceding->id,
            "archivamiento"
        );
        //------------------------------------

        return redirect()->route('secretaries.procedings.index')->with(['mensaje' => 'Archivado correctamente', 'color' => 'info']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proceding  $proceding
     * @return \Illuminate\Http\Response
     */
    public function edit(Proceding $proceding)
    {
        // $proceding->update([
        //     'status' => '3',
        // ]);
        // return redirect()->route('secretaries.procedings.index')->with(['mensaje' => 'Petición de Subsanación Enviada', 'color' => 'warning']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proceding  $proceding
     * @return \Illuminate\Http\Response
     */


    //FUNCION PARA LA DERIVACION DE DOCUMENTOS POR PARTE DEL SECRETARIO

    public function update(Request $request, Proceding $proceding)
    {
        $request->validate([
            'office' => 'required',
            'titulo' => 'required|max:100',
            'descripcion' => 'required|max:500',
        ]);


        $user = Auth::user();


        if ($request->office == $proceding->office_id) {
            return redirect()->route('secretaries.procedings.index')->with(['mensaje' => 'El expediente ya se encuentra en esta oficina', 'color' => 'warning']);
        } else {

            //EJECUTAR EN CASO SE COLOQUE LA OFICINA CORRECTA

            $proceding->update([
                'office_id' => $request->office,
                'status' => '2'
            ]);

            $oficina_destino = Office::findOrFail($request->office);

            Anotation::create([
                "title" => $request->titulo,
                "description" => $request->descripcion,
                "title" => $request->titulo,
                "proceding_id" => $proceding->id,
                "office_id" => $user->secretary->office->id,
                "user_id" => $user->secretary->user_id
            ]);

            $procedingControllerIncident = new AplicantProcedingController();
            $array_datos = $procedingControllerIncident->user_data();

            $oficina_remitente = $user->secretary->office->name;

            $destino = $oficina_destino->secretary->user->profile->name . " " . $oficina_destino->secretary->user->profile->lastname;

            $procedingControllerIncident->crearIncidente(
                $array_datos["ip"],
                $array_datos["nav"],
                $array_datos["so"],
                $user,
                $oficina_remitente,
                $oficina_destino->name,
                $destino,
                "Derivado",
                $proceding->id,
                "derivacion"
            );

            return redirect()->route('secretaries.procedings.index')->with(['mensaje' => 'Derivación correcta! (Ya no puedes gestionar este expediente)', 'color' => 'success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proceding  $proceding
     * @return \Illuminate\Http\Response
     */


    public function destroy(Proceding $proceding)
    {


        $user = Auth::user();

        //Solo identificara al rol admin, no se añade un else para el rol secretario ya que por ahora el admin puede ser secretario y admin a la vez
        foreach (Auth::user()->roles as $role) {

            if ($role->name == 'admin') {

                $procedingControllerIncident = new AplicantProcedingController();
                $array_datos = $procedingControllerIncident->user_data();

                $oficina_remitente = "-";

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
                    "eliminacion"
                );


                //REVISANDO LOS ANSWERS QUE NO TIENEN DOCUMENTOS
                $answers = Answer::DoesntHave('documents')->get();
                    foreach ($answers as $answer) {
                        if ($answer->proceding_id == $proceding->id) {
                          $answer->delete(); //borrando respuesta sola - sin documento
                        }
                    }



                //REVISANDO LOS ANSWERS QUE SI TIENEN DOCUMENTOS
                $ans = Answer::Has('documents')->get();
                    foreach ($ans as $an) {

                        if ($an->proceding_id == $proceding->id) {

                            $an->documents()->delete();//borrando registro de documento

                            foreach ($an->documents as $doc) {
                                Storage::delete($doc->url); //borrando pdf
                            }

                            $an->delete(); //borrando respuesta
                        }
                    }

                foreach ($proceding->documents as $document) {
                    Storage::delete($document->url);
                }
            }

            $proceding->delete();
            $proceding->documents()->delete();

        }
        return redirect()->route('admin.procedings.procedingadmin')->with(['mensaje' => 'Expediente eliminado correctamente', 'color' => 'danger']);
    }
}
