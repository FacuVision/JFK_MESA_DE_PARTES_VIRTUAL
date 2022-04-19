<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;


    protected $guarded = [];

    //una respuesta pertenece a un secretario

    public function secretary()
    {
        return $this->belongsTo(Secretary::class);
    }

    //una respuesta hace referencia a un expediente
    public function proceding()
    {
        return $this->belongsTo(Proceding::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class,'documentable');
    }
}
