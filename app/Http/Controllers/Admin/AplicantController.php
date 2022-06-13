<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aplicant;
use App\Models\User;
use Illuminate\Http\Request;

class AplicantController extends Controller
{
    public function FunctionName()
    {
        $this->middleware("can:admin.aplicants.index")->only("index");
        $this->middleware("can:admin.aplicants.create")->only("store","create");
        $this->middleware("can:admin.aplicants.destroy")->only("destroy");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aplicants = Aplicant::all();

        return view('admin.aplicants.index', compact('aplicants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users = User::select()->orderBy("name")->get();

        // foreach ($users as $user) {
            // if ($user->secretary() == null) {
            //    echo $user . "<br>";
            // }
        // }
        $users_sin_rol=User::doesntHave('aplicant')->doesntHave('secretary')->get();

        //DD($users_sin_rol);

        return view('admin.aplicants.create',compact('users_sin_rol'));
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

        $user = User::findOrFail($request->user_id);

        // if($user->secretary){
        //     return redirect()->route('admin.aplicants.index')->with('alerta','El usuario ya fue asignado como Secretario');
        // }elseif($user->aplicant){
        //     return redirect()->route('admin.aplicants.index')->with('alerta','El usuario ya fue asignado como Solicitante');
        // }else{

        Aplicant::create($request->all());
            return redirect()->route('admin.aplicants.index')->with('mensaje','El Solicitante fue creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aplicant  $aplicant
     * @return \Illuminate\Http\Response
     */
    public function show(Aplicant $aplicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aplicant  $aplicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Aplicant $aplicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aplicant  $aplicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aplicant  $aplicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplicant $aplicant)
    {
        $aplicant->user->removeRole("solicitante");
        $aplicant->delete();

        return redirect()->route('admin.aplicants.index')->with('danger', 'Solicitante desasignado correctamente');
    }
}
