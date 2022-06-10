<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserCreateRequest;
use App\Models\District;
use App\Models\Proceding;
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

        // $informacion = Proceding::where("created_at","<","2022-06-09")->get();
        // return $informacion;

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

        // $dist = [];
        // foreach($distritos as $ds){
        //     $dist[$ds['id']]= $ds['name'];
        // }

        $document = Type_document::all();

        $doc = [];
        foreach ($document as $dc){
            $doc[$dc['id']] = $dc['name'];
        }

        $sexo = $this->sexo;

        return view('admin.users.create', compact('sexo','doc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserCreateRequest $request)

    {

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
            "district_id" => $request->district_id,
            "phone" => $request->phone
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
        // $distritos = District::all();
        // $dist = [];
        // foreach($distritos as $ds){
        //     $dist[$ds['id']]= $ds['name'];
        // }

        $document = Type_document::all();
        $doc = [];
        foreach ($document as $dc){
            $doc[$dc['id']] = $dc['name'];
        }
        $sexo = $this->sexo;
        return view('admin.users.edit', compact('user','sexo','doc'));
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
        $sinpass = [
            "email" => "required|string|email|max:100",
            "name" => "required|string",
            "lastname" => "required|string",
            "date_nac" => "required",
            "type_document_id" => "required",
            "document_number" => "required|string|max:12",
            "gender" => "required|string",
            "address" => "required|max:100",
            "district_id" => "required",
            "phone" => "required|numeric",
        ];

        $conpass = [
            "email" => "required|string|email|max:100",
            "password" => "required|string",
            "name" => "required|string",
            "lastname" => "required|string",
            "date_nac" => "required",
            "type_document_id" => "required",
            "document_number" => "required|string|max:12",
            "gender" => "required|string",
            "address" => "required|max:100",
            "district_id" => "required",
            "phone" => "required|numeric",

        ];

        $con_correo_cp = [
            "email" => "required|string|email|max:100|unique:users",
            "password" => "required|string",
            "name" => "required|string",
            "lastname" => "required|string",
            "date_nac" => "required",
            "type_document_id" => "required",
            "document_number" => "required|string|max:12",
            "gender" => "required|string",
            "address" => "required|max:100",
            "district_id" => "required",
            "phone" => "required|numeric",

        ];

        $con_correo_sp = [
            "email" => "required|string|email|max:100|unique:users",
            "name" => "required|string",
            "lastname" => "required|string",
            "date_nac" => "required",
            "type_document_id" => "required",
            "document_number" => "required|string|max:12",
            "gender" => "required|string",
            "address" => "required|max:100",
            "district_id" => "required",
            "phone" => "required|numeric",

        ];

        if($user->email == $request->email){
            if($request->password == ""){
                $request->validate($sinpass);
                $user->update(['name' => $request->name]);

            }else{
                $request->validate($conpass);
                $user->update(['name' => $request->name, 'password' => bcrypt($request->password)]);
            }

        }else{
            if($request->password == ""){
                $request->validate($con_correo_sp);
                $user->update(['name' => $request->name, 'email' => $request->email]);
            }else{
                $request->validate($con_correo_cp);
                $user->update(['name' => $request->name, 'password' => bcrypt($request->password), 'email' => $request->email]);
            }
        }

        $user->profile->update($request->only("name","lastname","date_nac","gender","address","document_number","type_document_id","district_id","phone"));

        return redirect()->route('admin.users.edit', $user)->with('mensaje','Usuario Modificado correctamente');
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
