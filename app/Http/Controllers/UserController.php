<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user =  Auth::user();
        $con_correo= [
            "email" => "required|string|email|max:100|unique:users",
            "name" => "required|string",
            "lastname" => "required|string",
            "date_nac" => "required",
            "address" => "required|max:100",
        ];
        $sin_correo= [
            "email" => "required|string|email|max:100",
            "name" => "required|string",
            "lastname" => "required|string",
            "date_nac" => "required",
            "address" => "required|max:100",
        ];
        if($request->email == $user->email){
            $request->validate($sin_correo);
            $user->update(['name' => $request->name,]);
            $user->profile->update([
                'name'=>$request->name,
                'lastname'=>$request->lastname,
                'date_nac'=>$request->date_nac,
                'address'=>$request->address,
            ]);
        }else{
            $request->validate($con_correo);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $user->profile->update([
                'name'=>$request->name,
                'lastname'=>$request->lastname,
                'date_nac'=>$request->date_nac,
                'address'=>$request->address,
            ]);
        }
        return redirect()->route('profile.show')->with('mensaje','Datos modificados correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
