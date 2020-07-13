<?php

namespace App;
use Jenssegers\Date\Date;

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

    public function getFormattedDate($format)
    {
        Date::setLocale('es');
        $date = Date::parse($this->attributes['date'])->format($format);
        return $date;
    }
}
