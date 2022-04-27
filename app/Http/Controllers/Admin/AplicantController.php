<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aplicant;
use Illuminate\Http\Request;

class AplicantController extends Controller
{
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
        //
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
    public function update(Request $request, Aplicant $aplicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aplicant  $aplicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplicant $aplicant)
    {
        //
    }
}
