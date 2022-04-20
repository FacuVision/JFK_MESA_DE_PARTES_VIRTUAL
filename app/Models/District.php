<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $guarded = [];

    //un distrito puede aparecer en muchos profiles

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
