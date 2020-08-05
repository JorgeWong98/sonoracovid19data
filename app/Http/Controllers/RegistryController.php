<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Validator;

use \App\Registry;
use \App\City;

class RegistryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request['date'];
        if (is_null($date)) {
            return view('dashboard.index_registry');
        }
        else{
            $cities = City::orderBy('name', 'desc')->get();
            $registries = Registry::where('date', $date)->get();

            foreach ($cities as $city) {
                foreach ($registries as $registry) {
                    if ($city->id == $registry->city_id) {
                        $city['infections'] = $registry->infections;
                        $city['deaths'] = $registry->deaths;
                        $city['registry'] = $registry->id;
                    }
                }
                if (!isset($city->infections)) {
                    $city['infections'] = 0;
                    $city['deaths'] = 0;
                    $city['registry'] = 0;
                }
            }
            return view('dashboard.index_registry',
                [
                    'cities' => $cities,
                    'date' => $date
                ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = Date::now()->setTimezone('America/Tijuana');
        $registry = Registry::where('date', $today->format('Y-m-d'))->count();
        if ($registry == 0) {
            $cities = City::all();
            return view('dashboard.create_registry', [
                    'cities' => $cities,
                    'today' => $today
                ]);
        }
        else {
            Session::flash('message', 'Ya existe registro del dia de hoy.');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $today = Date::now()->setTimezone('America/Tijuana')->format('Y-m-d');

            $rules = [
                'date' => "required|date_format:Y-m-d|before_or_equal:$today",
            ];

            $messages = [
                'date.required' => "La <strong>fecha</strong> es requerida.",
                'date.date_format' => "La <strong>fecha</strong> tiene un formato incorrecto.",
                'date.before_or_equal' => "La <strong>fecha</strong> no debe ser posterior al día de hoy."
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withInput()
                            ->withErrors($validator);
            }

            $count = Registry::where('date', $request->date)->count();

            if ($count == 0) {
                $registry = Registry::where('date', $today);
                $cities = [];
                foreach ($request->all() as $key => $item) {
                    if (gettype($key) == "integer") {
                        $city = City::findOrFail($key);
                        array_push($cities, [
                            'id' => $city->id,
                            'infections' => $item[0],
                            'deaths' => $item[1],
                        ]);
                    }
                }

                foreach ($cities as $city) {
                    $registry = Registry::create([
                        'city_id' => $city['id'],
                        'infections' => $city['infections'],
                        'deaths' => $city['deaths'],
                        'date' => $request->date
                    ]);
                }
                Session::flash('message', 'Registro completado.');
                return redirect('dashboard/registros');
            }
            else{
                $errors = ['custom_error' => "Ya existen registros con la <strong>fecha</strong> seleccionada."];

                return redirect()
                            ->back()
                            ->withInput()
                            ->withErrors($errors);
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

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
