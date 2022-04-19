<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_document extends Model
{
    use HasFactory;
    protected $guarded = [];

    //un tipo de documento puede aparecer en muchos profiles

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

}
