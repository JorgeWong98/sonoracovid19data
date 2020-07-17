@extends('layouts.public')

@section('styles')
    <link rel="stylesheet" href="/css/city.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <h2>Datos de la ciudad de <strong>{{$city->name}}</strong>.</h2><br>
                    <p class="text">
                        Datos al {{$city->registries[0]->getFormattedDate("l\\, d \\d\\e F \\d\\e Y")}}.
                    </p>
                    <div class="data">
                        <span class="data-item">
                            <i class="fas fa-head-side-virus"></i> Casos: {{number_format($city->getTotal('infections'))}}
                        </span>
                        <span class="data-item">
                            <i class="fas fa-exclamation-triangle"></i> Defunciones: {{number_format($city->getTotal('deaths'))}}
                        </span>
                        <span class="data-item">
                            <i class="fas fa-percentage"></i> de Letalidad:
                            @php
                                $lethality = $city->getTotal('deaths') /  $city->getTotal('infections') * 100;
                                $format = number_format($lethality, 2);
                                echo("$format");
                            @endphp
                        </span>
                    </div>
                </div>
                <div class="graph-container">
                    <input type="hidden" id="city_id" value="{{$city->id}}">
                <p class="text">

                    Datos graficados diarios. Periodo: Últimos
                    <select class="form-control" style="width: auto; display:inline-block" id="period">
                        <option value="7" selected>7 días</option>
                        <option value="14">14 días</option>
                        <option value="31">31 días</option>
                    </select>
                </p>
                <canvas id="chartLine"></canvas>
                </div>
                <hr>
                <div class="row table-container">
                    <div class="col-md-12">
                        <p class="text">
                            Datos de los últimos 10 días de la ciudad.
                        </p>
                    </div>
                    <div class="col-md-8 table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th colspan="1"></th>
                                    <th colspan="2"><i class="fas fa-head-side-virus"></i> Casos</th>
                                    <th colspan="2"><i class="fas fa-exclamation-triangle"></i> Defunciones</th>
                                </tr>
                                <tr>
                                    <th scope="col"><i class="far fa-calendar-alt"></i> Fecha</th>
                                    <th scope="col"><i class="fas fa-search"></i> Registro</th>
                                    <th scope="col">
                                        <i class="fas fa-arrows-alt-v"></i>
                                        <a class="underline" data-toggle="tooltip" data-placement="top" title="Incremento o decremento de casos con respecto al día anterior.">Variacion</a>
                                    </th>
                                    <th scope="col"><i class="fas fa-search"></i> Registro</th>
                                    <th scope="col">
                                        <i class="fas fa-arrows-alt-v"></i>
                                        <a class="underline" data-toggle="tooltip" data-placement="bottom" title="Incremento o decremento de defunciones con respecto al día anterior.">Variacion</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i <= 9; $i++)
                                    <tr>
                                        <td scope="row">{{ $city->registries[$i]->getFormattedDate("d-F-Y") }}</td>
                                        <td>{{$city->registries[$i]->infections}}</td>
                                        <td
                                            @if (substr($city->registries[$i]->diffInfections, 0, 1) == "+")
                                                class="inc"
                                            @else
                                                class="dec"
                                            @endif
                                        >
                                            {{$city->registries[$i]->diffInfections}}
                                        </td>
                                        <td>{{$city->registries[$i]->deaths}}</td>
                                        <td
                                            @if (substr($city->registries[$i]->diffDeaths, 0, 1) == "+")
                                                class="inc"
                                            @else
                                                class="dec"
                                            @endif
                                        >
                                            {{$city->registries[$i]->diffDeaths}}
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="/js/helpers.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        const URL_API = "{{env('APP_URL')}}/api/cities";
    </script>
    <script src="/js/city.js"></script>
@endsection
