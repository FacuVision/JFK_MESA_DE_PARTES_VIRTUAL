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
        $office  = Office::pluck('name','id')->toArray();
        notify()->success('El Expediente se ha registrado con éxito.', '¡Registrado!');
        
        return view('aplicant.create',compact('office','typedocument'))->with('mensaje','Tipo de Documento creado correctamente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'office_id'=>'required',
            'pdf1'=>'required|max:15000',
            'anexo'=>'max:15000',
        ]);

        $year = date('Y');
        $DesdeLetra = "A";
        $HastaLetra = "Z";
        $DesdeNumero = 1;
        $HastaNumero = 10000;
        $numeroAleatorio = rand($DesdeNumero, $HastaNumero);
    

        
    try {
            $code = Str::random(4) .'-'.$numeroAleatorio;
            $pdf1 = $request->file('pdf1');
            $anexo = $request->file('pdf2');
            $user_id = Auth()->user()->id;
        

            $procedings=Proceding::create([
                'code'=>$code,
                'title'=>$request->title,
                'content'=>$request->content,
                'n_foly'=>$request->n_foly,
                'reference'=>'referencia por modificar',
                'status'=>1, //"enviado"
                'office_id'=>$request->office_id,
                'user_id'=>$user_id,
                'type_proceding_id'=>$request->typedocument_id //tipo de exp
            ]);
        

            if($pdf1!=null){
                $filename =$year.'-'.strtr($pdf1->getClientOriginalName(), " ", "_");
                $foo = $pdf1->extension();
                if($foo == 'pdf'){
                    // se crea una carpeta con el id del usuario
                    if(Storage::putFileAs('/public/principal/'.$user_id. '/', $pdf1,$filename)){

                        $procedings->documents()->create([
                            'documentable_id'=>$procedings->id,
                            'documentable_type'=>Proceding::class,
                            'type'=>'0',
                            'url'=>$filename
                            
                        ]);
                    }
                    //en file se guardan los pfs subidos.
                    // $route_file = 'principal'.DIRECTORY_SEPARATOR.date('Ymdhmi').'.'.$foo;
                    // Storage::disk('public')->put($route_file,$filename);               
                }
            
            }

            if($anexo!=null){
                $anexoName =$year.'-'.strtr($anexo->getClientOriginalName(), " ", "_");
                $foo = $anexo->extension();
                if($foo == 'pdf'){
                     // se crea una carpeta con el id del usuario
                    if(Storage::putFileAs('/public/principal/'. $user_id. '/', $anexo, $anexoName)){


                        $procedings->documents()->create([
                            'documentable_id'=>$procedings->id,
                            'documentable_type'=>Proceding::class,
                            'type'=>'1',
                            'url'=>$anexoName
                        ]);
                    }
                    //en file se guardan los pfs subidos.
                    // $route_anexo = 'file'.DIRECTORY_SEPARATOR.date('Ymdhmi').'.'.$foo;
                    // Storage::disk('public')->put($route_anexo,$anexoName);               
                }
            }
          //
    
        } catch (\Throwable $th) {

           // return redirect()->route('aplicant.procedings.create');
        }

        return redirect()->with('mensaje','Tipo de Documento creado correctamente');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
