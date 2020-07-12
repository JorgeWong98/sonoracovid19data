<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Registry;

class CityController extends Controller
{
    function getAll()
    {
        $cities =  City::all();
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
}
