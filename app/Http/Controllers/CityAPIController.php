<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Registry;
use Illuminate\Support\Facades\DB;

class CityAPIController extends Controller
{
    function getAll(Request $request)
    {
        $orderBy = $request->query('orderBy');
        $cities;
        if (!is_null($orderBy)) {
            if ($orderBy == 'infections' || $orderBy == 'deaths') {
                $cities = City::select(
                    "cities.id",
                    "cities.name",
                    DB::raw("sum(registries.$orderBy) as total"),
                    )
                        ->join('registries', 'cities.id', '=', 'registries.city_id')
                        ->groupBy('cities.name', 'cities.id')
                        ->orderBy('total', 'DESC')
                        ->get();
            }
            else{
                return response()->json('El tipo de orden es invalido', 400);
            }
        }
        else{
            $cities =  City::all();
        }
        return $cities;
    }

    function find($id)
    {
        try {
            $city = City::findOrFail($id);
            return $city;
        } catch (\Throwable $th) {
            return response('Id de la ciudad invalido.', 400);
        }
    }

    function getCityData(Request $request, $id)
    {
        try {
            $city = City::findOrFail($id);
            $data;
            $lastDays = request()->query('lastDays');
            if (!is_null($lastDays) && ctype_digit($lastDays)) {
                $city['registries'] = Registry::where('city_id', $city->id)
                                ->orderBy('date', 'DESC')
                                ->take($lastDays)
                                ->get();
            }
            else {
                $city['registries'] = $city->registries;
            }
            return response()->json($city, 200);
        } catch (\Throwable $th) {
            $message = "";
            switch ($th->getCode()) {
                case 0:
                    $message = "Id de la ciudad invalido.";
                    break;
                default:
                    $massage = "Codigo de error: " . $th->getCode();
                    break;
            }
            return response($message, 400);
        }
    }

    public function getAccumulated($id)
    {
        $cities = City::select(
            "cities.name",
            DB::raw("sum(registries.infections) as infections"),
            DB::raw("sum(registries.deaths) as deaths"),
            )
                ->join('registries', 'cities.id', '=', 'registries.city_id')
                ->where('cities.id', $id)
                ->groupBy('cities.name')
                ->get();
        return response()->json($cities[0], 200);;
    }
}
