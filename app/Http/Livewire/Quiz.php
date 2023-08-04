<?php

namespace App\Http\Livewire;

use App\Models\Quiz as Quizz;
use Livewire\Component;

class Quiz extends Component
{

    public $open = false;

    public $usa1;
    public $usa2;
    public $fun1;
    public $fun2;
    public $acc1;
    public $acc2;

    protected $rules = [
        "usa1" => "required",
        "usa2" => "required",
        "fun1" => "required",
        "fun2" => "required",
        "acc1" => "required",
        "acc2" => "required",
    ];
    protected $messages = [
        'usa1.required' => 'Seleccione una opción.',
        'usa2.required' => 'Seleccione una opción.',
        'fun1.required' => 'Seleccione una opción.',
        'fun2.required' => 'Seleccione una opción.',
        'acc1.required' => 'Seleccione una opción.',
        'acc2.required' => 'Seleccione una opción.',
    ];

    public function alert($tipo,$mensaje){
        session()->flash($tipo,$mensaje);
    }

    public function enviar(){

        $this->validate();

        Quizz::create([
            'usa1' => ''.$this->usa1,
            'usa2' => ''.$this->usa2,
            'fun1' => ''.$this->fun1,
            'fun2' => ''.$this->fun2,
            'acc1' => ''.$this->acc1,
            'acc2' => ''.$this->acc2,
        ]);
        $this->alert('success','Gracias por dejarnos tu opinion!');
        return redirect()->route("dashboard");
    }

    public function restore(){
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.quiz');
    }
}
