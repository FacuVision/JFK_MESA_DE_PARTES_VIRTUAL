<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\Secretary;
use App\Models\User;
use Illuminate\Http\Request;

class SecretaryController extends Controller
{
    public function __construct() {
        $this->middleware("can:admin.secretaries.index")->only("index");
        $this->middleware("can:admin.secretaries.create")->only("store","create");
        $this->middleware("can:admin.secretaries.edit")->only("edit","update");
        $this->middleware("can:admin.secretaries.destroy")->only("destroy");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $secretaries = Secretary::all();
        return view('admin.secretaries.index', compact('secretaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$users = User::select()->orderBy("name")->get();

        $users_sin_rol=User::doesntHave('aplicant')->doesntHave('secretary')->get();

        $offices = Office::doesntHave('secretary')->get();

        return view('admin.secretaries.create',compact('users_sin_rol','offices'));
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
            "user_id" => "required"
        ]);

        // $user = User::findOrFail($request->user_id);

        // if($user->secretary){
        //     return redirect()->route('admin.secretaries.index')->with('alerta','El usuario ya fue asignado como Secretario');
        // }elseif($user->aplicant){
        //     return redirect()->route('admin.secretaries.index')->with('alerta','El usuario ya fue asignado como Solicitante');
        // }else{

        Secretary::create($request->all());
        return redirect()->route('admin.secretaries.index')->with('mensaje','El Secretario fue creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Secretary  $secretary
     * @return \Illuminate\Http\Response
     */
    public function show(Secretary $secretary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Secretary  $secretary
     * @return \Illuminate\Http\Response
     */
    public function edit(Secretary $secretary)
    {

        $offices = Office::all();
        return view('admin.secretaries.edit', compact('offices','secretary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Secretary  $secretary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Secretary $secretary)
    {
        foreach (Secretary::all() as $sec) {
            if ($sec->office->id == $request->office_id) {
                return redirect()->route('admin.secretaries.index')->with('alerta','Esta oficina ya ha sido asignada a un secretario');
            }
        }

        $secretary->update($request->all());
        return redirect()->route('admin.secretaries.index')->with('mensaje','Secretario fue modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secretary  $secretary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secretary $secretary)
    {

        $secretary->user->removeRole("secretario");
        $secretary->delete();
        return redirect()->route('admin.secretaries.index')->with('eliminado', 'Secretario desasignado correctamente');
    }
}
