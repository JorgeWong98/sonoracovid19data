<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registry extends Model
{
    protected $fillable = [
        'infections', 'deaths', 'date', 'city_id'
    ];

     // -------- Relaciones ------------

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
