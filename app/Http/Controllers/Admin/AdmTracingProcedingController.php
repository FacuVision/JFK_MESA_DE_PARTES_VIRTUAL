<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proceding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmTracingProcedingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Solo identificara al rol admin, no se añade un else para el rol secretario ya que por ahora el admin puede ser secretario y admin a la vez
            foreach (Auth::user()->roles as $role) {
                if ($role->name == 'admin') {
                    $procedings = Proceding::all();
                }
            }
        //Si no se identificó el rol de admin, procedings no estara definido
        //Para ello la siguiente condicional lo determinara y sabra que es secretario
        if (!isset($procedings)) {
            $procedings = Auth::user()->secretary->office->procedings;
        }

        return view("secretaries.procedings.tracings.index", compact("procedings"));
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
     * @param  \App\Models\Proceding  $proceding
     * @return \Illuminate\Http\Response
     */
    public function show(Proceding $tracing)
    {
        $incidents = $tracing->incidents;
        return view("secretaries.procedings.tracings.show", compact("incidents", "tracing"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proceding  $proceding
     * @return \Illuminate\Http\Response
     */
    public function edit(Proceding $proceding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proceding  $proceding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proceding $proceding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proceding  $proceding
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proceding $proceding)
    {
        //
    }
}
