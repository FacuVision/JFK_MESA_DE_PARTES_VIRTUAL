<?php

namespace App\Http\Livewire;

use App\Models\Departament;
use App\Models\District;
use App\Models\Province;
use Livewire\Component;

class RegisterComponent extends Component
{

    public $department,$province,$district;
    public $provinces = [], $districts = [];


    public function mount()
    {
        $this->departments = Departament::all();
        $this->provinces = collect();
        $this->districts = collect();

    }

    public function updatedDepartment($value){
        $this->provinces = Province::where('departament_id', $value)->get();
        //$this->province = $this->provinces->first()->id ?? null;
    }

    public function updatedProvince($value){
        $this->districts = District::where('province_id', $value)->get();
        //$this->district = $this->districts->first()->id ?? null;
    }

    public function render()
    {
        return view('livewire.register-component');
    }


}
