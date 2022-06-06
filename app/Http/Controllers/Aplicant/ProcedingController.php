<?php

namespace App\Http\Controllers\Aplicant;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use App\Models\Aplicant;
use App\Models\Document;
use App\Models\Incident;
use Illuminate\Http\Request;

use App\Models\Type_document;
use App\Models\Type_proceding;
use App\Models\Office;
use App\Models\Proceding;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcedingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('aplicant.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$typedocument = TypeDocument::all();
        $typedocument  = Type_proceding::pluck('name','id')->toArray();
        $docsubsanar = Proceding::where(['status'=>3,'user_id'=>Auth()->user()->id])->pluck('title','code')->toArray();


        $office  = Office::pluck('name','id')->toArray();

        // tipo : mensaje
        //mensaje: Expediente enviado satisfactoriamente
        //session()->flash('mensaje','Expediente enviado satisfactoriamente');
        //$this->alert('success','Expediente enviado //satisfactoriamente');


        return view('aplicant.create',compact('office','typedocument','docsubsanar'));
    }

    public function alert($tipo,$mensaje){
        session()->flash($tipo,$mensaje);
        // session()->flash('alert');
    }


    public function store(DocumentRequest $request)
    {
        $year = date('Y');
        $DesdeNumero = 1;
        $HastaNumero = 10000;
        $numeroAleatorio = rand($DesdeNumero, $HastaNumero);

        $code = Str::random(4) .'-'.$numeroAleatorio;
        $pdf1 = $request->file('pdf1');
        $anexo = $request->file('pdf2');
        $user = Auth()->user();

        //se cambia los puntos por '' vacío
        $cadena =str_replace('.','', $user->name);
        //este nombre es para la carpeta que se creará
        $nomArchivo = preg_replace("/\s+/u", "", $cadena );

        //DATOS DEL DE IN(CIDENTE
        $ip = getenv('REMOTE_ADDR');
        $navigator=getenv('HTTP_USER_AGENT');
        $s1 = " (";
        $separada = explode($s1, $navigator);
        $cadena = $separada[1];
        $s2 = ")";
        $so = explode($s2, $cadena);
        $os_origin = $so[0]; // sistema oeprativo

        $cadena2 = $separada[2];
        $s3 = ")";
        $navegador = explode($s3, $cadena2);
        $nav= $navegador[1];  //navegador


        //oficina destino
        $office = Office::find($request->office_id);
        $fullname = $office->secretary->user->profile->name.' '.$office->secretary->user->profile->lastname;
        //nombres y apellidos del usuario

        try {
                /***
                 * crear 2 flujos:
                 * - 1 "tipo de exp. otros" expediente con o sin anexos .
                 * - 2 subsananción de exp.
                 * - 3 Solicitudes normales
                 */
                //CUANDO EL TIPO DE EXP. ES "OTROS"
                if($request->typedocument_id == '12'){
                    // se crea un nuevo tipo de proceding
                    $NewTypeProceding =Type_proceding::create([
                        'name'=>strtoupper($request->newtipodoc),
                        'description'=>$request->newtipodoc,
                        'type'=>'user'
                    ]);
                    $id_nuevo_proceding = $NewTypeProceding->id;
                    $procedings = $this->crearSolicitud($code,$request,'-',1,$user,$id_nuevo_proceding);

                    $this->crearArchivos($pdf1,$anexo,$year,$user,$nomArchivo,$procedings);

                    //code...
                    $this->crearIncidente($ip,$nav, $os_origin,$user,$office,$fullname,'Enviado',$procedings->id);

                    $this->alert('success','Expediente enviado satisfactoriamente');
                }
                //CUANDO ES SUBSANANACIÓN
                // al realizar esta acción el estado del expediente al que hace referencia debe estar estado 'subsanado
                else if($request->typedocument_id == '11'){
                    // crear expediente haciendo referencia al 'code' del que hace referencia a la subsanación
                    //CREAR ARCHIVOS PDFS Y ANEXOS

                    // MODIFICACIÓN DEL ESTADO DEL EXPEDIENTE A SUBSANAR
                    $exp = Proceding::where(['code'=>$request->referencia,'user_id'=>$user->id])->first();
                    //ESTADO "SUBSANADO"
                    $exp->status = '6';
                    $exp->save();

                    // obtenemos el id de exp. referente para modificar el estado
                    $procedings = $this->crearSolicitud($request->referencia,$request,$request->referencia,1,$user,$request->typedocument_id );

                    $this->crearArchivos($pdf1,$anexo,$year,$user,$nomArchivo,$procedings);

                    $this->crearIncidente($ip,$nav, $os_origin,$user,$office,$fullname,'Subsanado',$procedings->id);


                    $this->alert('success','Subsanación de Expediente enviado satisfactoriamente');
                }else{
                    // se crea Solicitudes normales
                    $this->crearArchivos($pdf1,$anexo,$year,$user, $nomArchivo,$this->crearSolicitud($code,$request,'-',1,$user,$request->typedocument_id));
                    $this->crearIncidente($ip,$nav, $os_origin,$user,$office,$fullname,'Enviado',$request->typedocument_id );
                    $this->alert('success','Expediente enviado satisfactoriamente');
                }
            } catch (\Throwable $th) {
                    $this->alert('error','¡Error!, Comuníquece con el soporte');
                return redirect()->route('aplicant.procedings.create');
            }
        return redirect()->route('aplicant.procedings.create');
    }

    public function crearIncidente($ip,$nav, $os_origin,$user,$office,$fullname,$status,$id_nuevo_proceding){
        Incident::create([
            'ip_origin'=>strval($ip),
            'navigator_origin'=>strval($nav),
            'os_origin'=>strval($os_origin),
            'office_remitent'=>'-',
            'remitent'=>strval($user->profile->name ." ". $user->profile->lastname),
            'office_destiny'=>strval($office->name),
            'destiny'=>strval($fullname),
            'status'=>strval($status),
            'transaction_type'=>'envio', //revisar las migraciones
            'proceding_id'=>$id_nuevo_proceding,
            ]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }




            //funcion | crear un proceding
            public function crearSolicitud($code,$request,$referencia,$estado,$user,$typeProceding_id){

            $procedings=Proceding::create([
            'code'=>$code,
            'title'=>$request->title,
            'content'=>$request->content,
            'n_foly'=>$request->n_foly,
            'reference'=>$referencia,
            'status'=>$estado, //"enviado"
            'office_id'=>$request->office_id,
            'user_id'=>$user->id,
            'type_proceding_id'=>$typeProceding_id //tipo de exp
            ]);
            //retorna el modelo
            return $procedings;
            }
            //función 2 | crear archivos
            public function crearArchivos($pdf1,$anexo,$year,$user,$nomArchivo,$procedings){
                    if($pdf1!=null){
                        $filename =$year.'-'.strtr($pdf1->getClientOriginalName(), " ", "_");
                        $filename =$year.'-'.strtr($pdf1->getClientOriginalName(), " ", "_");
                        $foo = $pdf1->extension();
                        if($foo == 'pdf'){
                            // se crea una carpeta con el id del usuario
                            if(Storage::putFileAs('/public/principal/'.$user->id.'-'.$nomArchivo.'/', $pdf1,$filename)){
                                $procedings->documents()->create([
                                    'documentable_id'=>$procedings->id,
                                    'documentable_type'=>Proceding::class,
                                    'type'=>'0',
                                    'url'=>$filename
                                ]);
                            }
                        }
                    }
                    if($anexo!=null){
                        $anexoName =$year.'-'.strtr($anexo->getClientOriginalName(), " ", "_");
                        $foo = $anexo->extension();
                        if($foo == 'pdf'){
                             // se crea una carpeta con el id del usuario
                            if(Storage::putFileAs('/public/file/'. $user->id.'-'.$nomArchivo.'/', $anexo, $anexoName)){
                                $procedings->documents()->create([
                                    'documentable_id'=>$procedings->id,
                                    'documentable_type'=>Proceding::class,
                                    'type'=>'1',
                                    'url'=>$anexoName
                                ]);
                            }
                        }
                    }
                }



}
