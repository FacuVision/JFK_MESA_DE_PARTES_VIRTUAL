<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type_document;
use App\Models\Type_proceding;
use Illuminate\Http\Request;

class TypeProcedingController extends Controller
{

    public function index()
    {
        $tipoexpedientes=Type_proceding::orderBy('id', 'ASC')->get();
       
        return view('admin.typeprocedings.index',compact('tipoexpedientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = ["user"=>"User","system"=>"System"];
        return view('admin.typeprocedings.create',compact('tipos'));
        
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
            'name'=>'required',
            'description' =>'required',
            'type'=>'required'
        ]);

        Type_proceding::create([
            'name' =>$request->name,
            'description' =>$request->description,
            'type' =>$request->type,

        ]);
        return redirect(route('admin.typeprocedings.create'))->with('mensaje','Tipo de Documento creado correctamente');
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
    public function edit( $id)
    {
        $tipoexpediente=Type_proceding::find($id);
        $tipos = ["user"=>"User","system"=>"System"];
        return view(('admin.typeprocedings.edit'),compact('tipoexpediente','tipos'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'description' =>'required',
            'type'=>'required'
        ]);
        
        try {
            $dato =  Type_proceding::find($id);
            $dato->update($request->all());
            
        } catch (\Throwable $th) {
            return back()->with('mensaje','error');
        }
        return redirect(route('admin.typeprocedings.edit',$id))->with('mensaje','Tipo de Expediente se ha actualziado correctamente');

        //return redirect(route('admin.typeprocedings.edit'))->with('mensaje','Tipo de Expediente se ha actualziado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Type_proceding::destroy($id);
        } catch (\Throwable $th) {
            
        }
        return redirect(route('admin.typeprocedings.index'))->with(array('mensaje'=>'Registro Eliminado Satisfactorimente','color'=>'success'));
        
    }
}
