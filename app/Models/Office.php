<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $guarded = [];

    //una oficina puede aparecer en muchos resgistros de un expediente

    public function procedings()
    {
        return $this->hasMany(Proceding::class);
    }

    //una oficina por secretario

    public function secretary()
    {
        return $this->hasOne(Secretary::class);
    }

    public function anotations()
    {
        return $this->hasMany(Anotations::class);
    }
}
