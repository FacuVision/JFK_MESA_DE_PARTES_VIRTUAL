<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplicant extends Model
{
    protected $primaryKey = 'user_id';
    protected $guarded = [];

    use HasFactory;

    //un solicitante pertenece a un usuario

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    //un solicitante tiene uno a muchos expedientes

    public function procedings()
    {
        return $this->hasMany(Proceding::class);
    }
}
