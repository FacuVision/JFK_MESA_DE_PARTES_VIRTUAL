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
        //notify()->success('El Expediente se ha registrado con éxito.', '¡Registrado!');
        return view('aplicant.create',compact('office','typedocument'));
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
            'pdf1'=>'required',
        ]);

        $year = date('Y');
        
    try {
            $code = '0'.random_int(100, 999);
            //$code = 'DOC'.$year.'-'.strval($max_code+1);
            $pdf1 = $request->file('pdf1');
            $anexo = $request->file('pdf2');
        

            $procedings=Proceding::create([
                'code'=>$code,
                'title'=>$request->title,
                'content'=>$request->content,
                'n_foly'=>$request->n_foly,
                'reference'=>'referencia por modificar',
                'status'=>1, //"enviado"
                'office_id'=>$request->office_id,
                'user_id'=>Auth()->user()->id,
                'type_proceding_id'=>$request->typedocument_id //tipo de exp
            ]);
            $Proceding= Proceding::latest('id')->first();

            if($pdf1!=null){
                $filename = $pdf1->getClientOriginalName();
                $foo = $pdf1->extension();
                if($foo == 'pdf'){
                    //en file se guardan los pfs subidos.
                    $route_file = 'principal'.DIRECTORY_SEPARATOR.date('Ymdhmi').'.'.$foo;
                    Storage::disk('public')->put($route_file,$filename);               
                }
                $procedings->documents()->create([
                    'documentable_id'=>$Proceding->id,
                    'documentable_type'=>Proceding::class,
                    'type'=>'0',
                    'url'=>$route_file
                ]);
            
            }
            if($anexo!=null){
                $anexoName = $anexo->getClientOriginalName();
                $foo = $anexo->extension();
                if($foo == 'pdf'){
                    //en file se guardan los pfs subidos.
                    $route_anexo = 'file'.DIRECTORY_SEPARATOR.date('Ymdhmi').'.'.$foo;
                    Storage::disk('public')->put($route_anexo,$anexoName);               
                }
                $procedings->documents()->create([
                    'documentable_id'=>$Proceding->id,
                    'documentable_type'=>Proceding::class,
                    'type'=>'1',
                    'url'=>$route_anexo
                ]);
            }
           
            
    
        } catch (\Throwable $th) {

            return "Error";
            
        }
        

        return redirect()->route('aplicant.procedings.create');
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
