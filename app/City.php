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

    // public function getTotalInfections(){

    //     $cities = City::select(
    //         DB::raw('sum(registries.infections) as infections'),
    //         )
    //             ->join('registries', 'cities.id', '=', 'registries.city_id')
    //             ->where('cities.id', $this->attributes['id'])
    //             ->get();
    //     return \number_format($cities[0]->infections);
    // }

    public function getTotal($type){

        $cities = City::select(
            DB::raw("sum(registries.$type) as total"),
            )
                ->join('registries', 'cities.id', '=', 'registries.city_id')
                ->where('cities.id', $this->attributes['id'])
                ->get();
        return $cities[0]["total"];
    }
}
