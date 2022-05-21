<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proceding;
use Illuminate\Http\Request;

class CollectiveController extends Controller
{
    public function reject(Proceding $proceding)
    {
        $proceding->update([
            'status' => '5',
        ]);
        return redirect()->route('secretary.procedings.index')->with(['mensaje' => 'Expediente rechazado correctamente', 'color' => 'danger']);
    }

}
