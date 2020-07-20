@extends('layouts.public')

@section('styles')
    <link rel="stylesheet" href="/css/index.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="text">
                Últimos datos y acumulados de las ciudades de Sonora. Se está trabajando para incluir el resto de ciudades del estado.
            </p>
            <p class="text">
                Puede acceder a los datos de cada ciudad dando clic en su respectivo registro.
            </p>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th colspan="1"></th>
                            <th colspan="3">Último registro</th>
                            <th colspan="3">Acumulado</th>
                        </tr>
                        <tr>
                            <th scope="col"><a class="icon"><i class="fas fa-city"></i> Ciudad</a></th>
                            <th scope="col"><a class="icon"><i class="far fa-calendar-alt"></i> Fecha</a></th>
                            <th scope="col"><a class="icon"><i class="fas fa-head-side-virus"></i> Casos</a></th>
                            <th scope="col"><a class="icon"><i class="fas fa-exclamation-triangle"></i> Defunciones</a></th>
                            <th scope="col"><a class="icon"><i class="fas fa-head-side-virus"></i> Casos</a></th>
                            <th scope="col"><a class="icon"><i class="fas fa-exclamation-triangle"></i> Defunciones</a></th>
                            <th scope="col"><a class="icon"><i class="fas fa-percentage"></i> de Letalidad</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                            <tr class='clickable-row' data-href='ciudades/{{strtolower($city->name)}}'>
                                <td><a><i class="fas fa-external-link-alt"></i> - {{$city->name}}</a></td>
                                <td class="date">{{$city->getLastData('date')}}</td>
                                <td>{{$city->getLastData('infections')}}</td>
                                <td>{{$city->getLastData('deaths')}}</td>
                                <td>{{number_format($city->getTotal('infections'))}}</td>
                                <td>{{number_format($city->getTotal('deaths'))}}</td>
                                <td>
                                    @php
                                        $lethality = $city->getTotal('deaths') /  $city->getTotal('infections') * 100;
                                        $format = number_format($lethality, 2);
                                        echo("$format%");
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <br>
            <p class="text">
                Gráfica comparativa de los datos acumulados.
            </p>
            <div id="chart-container" class="chart-container">
                <div id="spinner" class="spinner">
                    <div class="spinner-border text-primary ml-auto" role="status" aria-hidden="true"></div>
                    <div>
                        <strong>Cargando datos ...</strong>
                    </div>
                </div>
                <canvas class="chartBar" id="chartBar"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="/js/helpers.js"></script>
    <script>
        const URL_API = "{{env('APP_URL')}}/api/cities";

        var cities = {!! json_encode($ids, JSON_HEX_TAG) !!};

        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
    <script src="/js/index.js"></script>
@endsection
