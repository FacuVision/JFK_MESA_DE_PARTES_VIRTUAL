<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Un profile pertenece a un usuario

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Un profile tiene un distrito

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    //Un profile tiene un tipo de documento

    public function type_document()
    {
        return $this->belongsTo(Type_document::class);
    }

}
