<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::all();
        return view('admin.offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offices.create');
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
            'name' => 'required|string|max:100|unique:offices',
            'description' => 'required|string|max:100|',
        ]);
        Office::create($request->all());
        return redirect()->route('admin.offices.index')->with('mensaje','Oficina creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        return view('admin.offices.edit', compact('office'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        $cn = [ 'name' => 'required|string|max:100|unique:offices',
                'description' => 'required|string|max:100|'];
        $sn = [ 'name' => 'required|string|max:100',
                'description' => 'required|string|max:100|'];

        if($office->name == $request->name){
            $request->validate($sn);
            $office->update($request->all());
            return redirect()->route('admin.offices.index')->with('mensaje','Oficina modificada correctamente');
        }else{
            $request->validate($cn);
            $office->update($request->all());
            return redirect()->route('admin.offices.index')->with('mensaje','Oficina modificada correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();
        return redirect()->route('admin.offices.index')->with('mensaje', 'Oficina eliminada correctamente');
    }
}
