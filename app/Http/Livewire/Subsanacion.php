<?php

namespace App\Http\Livewire;

use App\Models\Proceding;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Subsanacion extends Component
{
    public function render()
    {
        //Listar expedientes por subsanar y que sean del usuario logeado (perfil solicitante)
        //estado: por subsanar
        // user_
        $docsubsanar = Proceding::where(['status'=>3,'user_id'=>Auth()->user()->id])->pluck('title','code')->toArray();

        return view('livewire.subsanacion',compact('docsubsanar'));
    }
}
