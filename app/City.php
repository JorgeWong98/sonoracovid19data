<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name'
    ];

     // -------------- Mutadores ---------------------

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }
}
