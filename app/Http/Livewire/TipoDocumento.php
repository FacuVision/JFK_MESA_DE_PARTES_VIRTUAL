<?php

namespace App\Http\Livewire;

use App\Models\Type_proceding;
use Livewire\Component;

class TipoDocumento extends Component
{
    public function render()
    {
        $typedocument  = Type_proceding::orderBy('id','asc')->pluck('name','id')->toArray();
        return view('livewire.tipo-documento',compact('typedocument'));
    }


    //activar campo al seleccionar 'otros' en tipo de documento
}
