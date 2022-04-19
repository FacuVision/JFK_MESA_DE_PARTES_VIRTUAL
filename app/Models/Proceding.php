<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceding extends Model
{
    use HasFactory;
    protected $guarded = [];


    //un expediente puede tener un solo tipo de documento

    public function type_proceding()
    {
        return $this->belongsTo(Type_proceding::class);
    }

    //un expediente puede tener un solo usuario (solicitante)

    public function aplicant()
    {
        return $this->belongsTo(Aplicant::class);
    }

    //un expediente puede ser enviado a una sola oficina

    public function office()
    {
        return $this->belongsTo(Office::class);
    }


        //un expediente puede tener una a muchas respuestas

        public function answers()
        {
            return $this->hasMany(Answer::class);
        }


        //un expediente puede tener una a muchas incidencias

        public function incidents()
        {
            return $this->hasMany(Incident::class);
        }

        public function documents()
        {
            return $this->morphMany(Document::class,'documentable');
        }

}
