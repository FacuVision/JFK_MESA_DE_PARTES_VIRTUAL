<?php

namespace App\Http\Livewire;

use App\Models\Proceding;
use Livewire\Component;

class ShowProcedings extends Component
{    public $district;

    public function render()
    {
        $this->districts = collect();
        $expsubsanar = Proceding::where(['status'=>3,'user_id'=>Auth()->user()->id])->get();//pluck('title','code')->toArray();

        return view('livewire.show-procedings',compact('expsubsanar'));
    }
}
