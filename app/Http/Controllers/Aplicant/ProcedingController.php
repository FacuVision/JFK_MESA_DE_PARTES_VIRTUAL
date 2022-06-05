<?php

namespace App\Http\Controllers\Aplicant;

use App\Http\Controllers\Controller;
use App\Models\Aplicant;
use App\Models\Document;
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
        $this->alert('success','Expediente enviado satisfactoriamente');

        
        return view('aplicant.create',compact('office','typedocument','docsubsanar'));
    }

    public function alert($tipo,$mensaje){
        session()->flash($tipo,$mensaje);
        // session()->flash('alert');
    }


    public function store(Request $request)
    {
        $request->validate([
            'office_id'=>'required',
            'pdf1'=>'required|max:15000|mimes:pdf',
            'anexo'=>'max:15000|mimes:pdf',
        ]);



        $year = date('Y');
        $DesdeNumero = 1;
        $HastaNumero = 10000;
        $numeroAleatorio = rand($DesdeNumero, $HastaNumero);

        $code = Str::random(4) .'-'.$numeroAleatorio;
        $pdf1 = $request->file('pdf1');
        $anexo = $request->file('pdf2');
        $user = Auth()->user();

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
                        'description'=>strtoupper($request->newtipodoc),
                        'type'=>'user'
                    ]);
                    $this->crearArchivos($pdf1,$anexo,$year,$user,$this->crearSolicitud($code,$request,'-',1,$user,$NewTypeProceding->id));
                    $this->alert('success','Expediente enviado satisfactoriamente');
                }
                //CUANDO ES SUBSANANACIÓN
                // al realizar esta acción el estado del expediente al que hace referencia debe estar estado 'corregido 
                else if($request->typedocument_id == '11'){
                    // crear expediente haciendo referencia al 'code' del que hace referencia a la subsanación
                    //CREAR ARCHIVOS PDFS Y ANEXOS
                    $this->crearArchivos($pdf1,$anexo,$year,$user,$this->crearSolicitud($request->referencia,$request,$request->referencia,1,$user,$request->typedocument_id ));

                    $this->alert('success','Subsanación de Expediente enviado satisfactoriamente');
                }else{
                    // se crea Solicitudes normales
                    $this->crearArchivos($pdf1,$anexo,$year,$user,$this->crearSolicitud($code,$request,'-',1,$user,$request->typedocument_id));
                    $this->alert('success','Expediente enviado satisfactoriamente');
                }
            } catch (\Throwable $th) {
                    $this->alert('error','¡Error!, Comuníquece con el soporte');
                return redirect()->route('aplicant.procedings.create');
            }
        return redirect()->route('aplicant.procedings.create');
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




            //funcion |
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
            //función 2
            public function crearArchivos($pdf1,$anexo,$year,$user,$procedings){
                    if($pdf1!=null){
                        $filename =$year.'-'.strtr($pdf1->getClientOriginalName(), " ", "_");
                        $foo = $pdf1->extension();
                        if($foo == 'pdf'){
                            // se crea una carpeta con el id del usuario
                            if(Storage::putFileAs('/public/principal/'.$user->id.'-'.$user->name. '/', $pdf1,$filename)){
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
                            if(Storage::putFileAs('/public/file/'. $user->id.'-'.$user->name.'/', $anexo, $anexoName)){
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
