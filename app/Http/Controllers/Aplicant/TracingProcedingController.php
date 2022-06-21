<?php

namespace App\Http\Controllers\Aplicant;

use App\Http\Controllers\Controller;
use App\Models\Proceding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TracingProcedingController extends Controller
{
    public function __construct() {
        $this->middleware("can:aplicants.tracings.index")->only("index");
        $this->middleware("can:aplicants.tracings.show")->only("show");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedings = Auth::user()->aplicant->procedings;
        return view("aplicant.tracings.index",compact("procedings"));
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
        $proceding = Proceding::findOrFail($request->id);

        foreach ($proceding->answers as $answer ) {
            $response = $answer->update(["read_status" => "1"]);
        }

        return response()->json($response);
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

        return view("aplicant.tracings.show",compact("incidents","tracing"));
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
