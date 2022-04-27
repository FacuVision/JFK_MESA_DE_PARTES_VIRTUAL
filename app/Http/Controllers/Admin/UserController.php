<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Type_document;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $sexo = ["m" => "Masculino", "f" => "Femenino"];

    public function index()
    {
        $users = User::orderBy('id', 'ASC')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $distritos = District::all();
        $dist = [];
        foreach($distritos as $ds){
            $dist[$ds['id']]= $ds['name'];
        }
        $document = Type_document::all();
        $doc = [];
        foreach ($document as $dc){
            $doc[$dc['id']] = $dc['name'];
        }

        $sexo = $this->sexo;
        return view('admin.users.create', compact('dist','sexo','doc'));
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
            "email" => "required|string|email|max:100|unique:users",
            "password" => "required|string",
            "name" => "required|string",
            "lastname" => "required|string",
            "date_nac" => "required",
            "type_document" => "required",
            "document_number" => "required|string|max:12",
            "gender" => "required|string",
            "address" => "required|max:100",
            "district" => "required",
        ]);
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);
        $user->profile()->create([
            "name" => $request->name,
            "lastname" => $request->lastname,
            "type_document_id" => $request->type_document,
            "document_number" => $request->document_number,
            "date_nac" => $request->date_nac,
            "gender" => $request->gender,
            "address" => $request->address,
            "district_id" => $request->district
            ]);
        return redirect()->route('admin.users.index')->with('mensaje', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $distritos = District::all();
        $dist = [];
        foreach($distritos as $ds){
            $dist[$ds['id']]= $ds['name'];
        }

        $document = Type_document::all();
        $doc = [];
        foreach ($document as $dc){
            $doc[$dc['id']] = $dc['name'];
        }
        $sexo = $this->sexo;
        return view('admin.users.edit', compact('user','dist','sexo','doc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('mensaje', 'Usuario eliminado correctamente');
    }
}
