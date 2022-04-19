<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_proceding extends Model
{
    use HasFactory;

    protected $guarded = [];

    //un tipo de expediente puede aparecer en los registros de muchos expedientes

    public function procedings()
    {
        return $this->hasMany(Proceding::class);
    }
}
