<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anotations extends Model
{
    use HasFactory;


    protected $guarded = [];

    //una respuesta pertenece a un secretario

    public function proceding()
    {
        return $this->belongsTo(Proceding::class);
    }
    public function secretary()
    {
        return $this->belongsTo(Secretary::class,'user_id');
    }
    public function office()
    {
        return $this->belongsTo(Office::class);
    }
}
