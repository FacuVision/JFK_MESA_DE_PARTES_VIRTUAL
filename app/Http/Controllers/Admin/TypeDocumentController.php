<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type_document;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type_document::all();
        return view('admin.typedocuments.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.typedocuments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(["name" => "required|string|max:50|unique:type_documents"]);
        Type_document::create($request->all());
        return redirect()->route('admin.typedocuments.index')->with('mensaje','Tipo de Documento creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type_document  $type_document
     * @return \Illuminate\Http\Response
     */
    public function show(Type_document $typedocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type_document  $type_document
     * @return \Illuminate\Http\Response
     */
    public function edit(Type_document $typedocument)
    {
        return view('admin.typedocuments.edit', compact('typedocument'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type_document  $type_document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type_document $typedocument)
    {

        if($request->name == $typedocument->name){
            return redirect()->route('admin.typedocuments.edit')->with('mensaje','No se realizaron cambios......');
        }else{
            $request->validate(["name" => "required|string|max:50|unique:type_documents"]);
            $typedocument->update($request->only('name'));
            return redirect()->route('admin.typedocuments.edit', $typedocument)->with('mensaje','Cambio realizado con exito');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type_document  $type_document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type_document $typedocument)
    {
        //Eliminar puede generar error

        if(count($typedocument->profiles) == 0){
            $typedocument->delete();
            return redirect()->route('admin.typedocuments.index')->with(['mensaje' => 'Tipo de Documento eliminado satisfactoriamente', 'color' => 'success']);
        }else{
            return redirect()->route('admin.typedocuments.index')->with(['mensaje' => 'No puedes borrar este tipo de documento porque esta siendo utilizado', 'color' => 'danger']);
        }

    }
}
