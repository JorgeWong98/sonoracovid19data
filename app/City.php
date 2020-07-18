<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

     // -------- Relaciones ------------

    public function registries()
    {
        return $this->hasMany('App\Registry');
    }

    // --------- Funciones ----------------

    public function getTotal($type){

        $cities = City::select(
            DB::raw("sum(registries.$type) as total"),
            )
                ->join('registries', 'cities.id', '=', 'registries.city_id')
                ->where('cities.id', $this->attributes['id'])
                ->get();
        return $cities[0]["total"];
    }

    public function getLastData($column, $format = null){
        $data = Registry::where('city_id', $this->attributes['id'])
                            ->orderBy('date', 'DESC')
                            ->get();
        if ($column != 'date') {
            return $data[0]["$column"];
        }
        else {
            $registry = $data[0];
            $format = (is_null($format) ? 'd-F-Y' : $format);

            $date = $registry->getFormattedDate($format);
            return $date;
        }
    }
}
