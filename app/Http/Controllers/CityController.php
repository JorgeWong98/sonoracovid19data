<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::
            select(
                'cities.id',
                'cities.name',
                DB::raw('sum(registries.infections) as infections'),
            )
            ->join('registries', 'cities.id', '=', 'registries.city_id')
            ->groupBy('cities.id', 'cities.name')
            ->orderBy('infections', 'DESC')
            ->get();

        $func = function($valor) {
            return $valor['id'];
        };

        $ids = array_map($func, $cities->toArray());

        return view('city.index', array('cities' => $cities, 'ids' => $ids));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        try {
            $name = strtoupper($name);
            $city = City::where('name', $name)->firstOrFail();
            $registries = $city->registries()->orderBy('date', 'desc')->get();
            for ($i=0; $i < $registries->count(); $i++) {
                $currentRegistry = $registries[$i];
                if ($i == $city->registries->count() -1) {
                    $currentRegistry['diffInfections'] = 0;
                    $currentRegistry['diffDeaths'] = 0;
                }
                else{
                    $lastRegistry = $registries[$i + 1];
                    $diffInfections = $currentRegistry->infections - $lastRegistry->infections;
                    $diffDeaths = $currentRegistry->deaths - $lastRegistry->deaths;

                    $currentRegistry['diffDeaths'] = ($diffDeaths >= 0) ? "+$diffDeaths" : $diffDeaths;
                    $currentRegistry['diffInfections'] = ($diffInfections >= 0) ? "+$diffInfections" : $diffInfections;
                }
            }
            return view('city', ['city' => $city, 'registries' => $registries]);
        } catch (\Throwable $th) {
            \abort(404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
