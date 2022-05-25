<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{

    protected $primaryKey = 'user_id';
    protected $guarded = [];

    use HasFactory;

    //un secretario pertenece a un usuario

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //un secretario pertenece a una oficina

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function anotations()
    {
        return $this->hasMany(Anotations::class, 'user_id');
    }
}
