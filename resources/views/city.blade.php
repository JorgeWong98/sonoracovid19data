@extends('layouts.public')

@section('styles')
    <link rel="stylesheet" href="/css/city.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="header">
                    <p class="text">
                        Datos al {{$city->registries[0]->getFormattedDate("l\\, d \\d\\e F \\d\\e Y")}}.
                    </p>
                    <div class="data">
                        <span class="data-item">
                            Infecciones: {{$city->registries->sum('infections')}}
                        </span>
                        <span class="data-item">
                            Defunciones: {{$city->registries->sum('deaths')}}
                        </span>
                    </div>
                </div>
                <div class="graph-container">
                    <input type="hidden" id="city_id" value="{{$city->id}}">
                <p class="text">
                    Datos de la ciudad de <strong>{{$city->name}}</strong>.
                    Periodo: Últimos
                    <select class="form-control" style="width: auto; display:inline-block" id="period">
                        <option value="7" selected>7 días</option>
                        <option value="14">14 días</option>
                        <option value="31">31 días</option>
                    </select>
                </p>
                <canvas id="chartLine"></canvas>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text">
                            Ultimos datos de la ciudad.
                        </p>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Infectados</th>
                                    <th scope="col">Variacion</th>
                                    <th scope="col">Defunciones</th>
                                    <th scope="col">Variacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i <= 7; $i++)
                                    <tr>
                                        <td scope="row">{{ $city->registries[$i]->getFormattedDate("d/F/Y") }}</td>
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
    <script src="/js/city.js"></script>
@endsection
