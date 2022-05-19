<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Incident;
use App\Models\Office;
use App\Models\Proceding;
use App\Models\Secretary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcedingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $secretary = Secretary::findOrFail(Auth::id());
        $procedings = $secretary->office->procedings;
        $offices = Office::all();
        return view('secretary.procedings.index', compact('procedings', 'offices'));
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
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'procedingid' => 'required|integer',
        ]);
        $proceding = Proceding::findOrFail($request->procedingid);

        Answer::create([
            'title' => $request->title,
            'content' => $request->content,
            'read_status' => '0',
            'proceeding_id' => $proceding->id,
            'user_id' => Auth::id(),
        ]);
        $proceding->update([
            'status' => '4',
        ]);

        // Incident::create([
        //     'office_remitent' => $proceding->office->name,
        //     'remitent' => Auth::email(),
        //     'office_destiny' => $proceding->office->name,
        //     'destiny' => Auth::email(),
        //     'status' => '',
        //     'proceding_id' => $proceding->id
        // ]);

        return redirect()->route('secretary.procedings.index')->with(['mensaje' => 'Respuesta Enviada', 'color' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proceding  $proceding
     * @return \Illuminate\Http\Response
     */
    public function show(Proceding $proceding)
    {

        $proceding->update([
            'status' => '4'
        ]);
         return redirect()->route('secretary.procedings.index')->with(['mensaje' => 'Archivado correctamente', 'color' => 'info']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proceding  $proceding
     * @return \Illuminate\Http\Response
     */
    public function edit(Proceding $proceding)
    {
        $proceding->update([
            'status' => '3',
        ]);
        return redirect()->route('secretary.procedings.index')->with(['mensaje' => 'Petición de Subsanación Enviada', 'color' => 'warning']);
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

        $request->validate([
            'office' => 'required',
        ]);
        if ($request->office == $proceding->office_id) {
            return redirect()->route('secretary.procedings.index')->with(['mensaje' => 'El expediente ya se encuentra en esta oficina', 'color' => 'warning']);
        } else {
            $proceding->update([
                'office_id' => $request->office,
                'status' => '2'
            ]);
            return redirect()->route('secretary.procedings.index')->with(['mensaje' => 'Derivación correcta!', 'color' => 'success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proceding  $proceding
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proceding $proceding)
    {
        $proceding->update([
            'status' => '5',
        ]);
        return redirect()->route('secretary.procedings.index')->with(['mensaje' => 'Expediente rechazado correctamente', 'color' => 'danger']);
    }
}
