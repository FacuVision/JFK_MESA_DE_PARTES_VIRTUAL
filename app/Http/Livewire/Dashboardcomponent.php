<?php

namespace App\Http\Livewire;

use App\Models\Aplicant;
use App\Models\Proceding;
use App\Models\Quiz;
use App\Models\Secretary;
use App\Models\User;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboardcomponent extends Component
{

    public function admin_obtener_cantidad_usuarios()
    {
        $secretarios = Secretary::all()->count();
        $aplicants = Aplicant::all()->count();
        $users = $secretarios+$aplicants;

        return [
            "users" => $users,
            "secretaries" => $secretarios,
            "aplicants" => $aplicants
        ];
    }

    public function admin_obtener_datos_documentos()
    {
        $enviados = Proceding::where("status","1")->get()->count();
        $respondidos = Proceding::where("status","4")->get()->count();

        return [
            "enviados" => $enviados,
            "respondidos" => $respondidos
        ];
    }


    public function secretario_obtener_datos_documentos()
    {
        //$user = Auth::user();

        $id = Auth::user()->secretary->office->id;

        $enviados = Proceding::where("status","1")->where("office_id",$id)->get()->count();
        $respondidos = Proceding::where("status","4")->where("office_id",$id)->get()->count();

        return [
            "secretary_enviados" => $enviados,
            "secretary_respondidos" => $respondidos
        ];
    }


    public function obtener_cantidad_encuesta()
    {
        //$user = Auth::user();



        $respuestas = Quiz::all()->count();

        return [
            "respuestas" => $respuestas,
        ];
    }




    public function render()
    {
        $array_users = $this->admin_obtener_cantidad_usuarios();
        $array_documentos = $this->admin_obtener_datos_documentos();
        $total = $this->obtener_cantidad_encuesta();

        if(Auth::user()->secretary != null){
            $secretario_array_documentos = $this->secretario_obtener_datos_documentos();
            return view('livewire.dashboardcomponent', compact("array_users", "array_documentos", "secretario_array_documentos","total"));
        }

        return view('livewire.dashboardcomponent', compact("array_users", "array_documentos","total"));
    }

}
