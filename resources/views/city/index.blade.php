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
                            <th scope="col"><i class="fas fa-city"></i> Ciudad</th>
                            <th scope="col"><i class="far fa-calendar-alt"></i> Fecha</th>
                            <th scope="col"><i class="fas fa-head-side-virus"></i> Casos</th>
                            <th scope="col"><i class="fas fa-exclamation-triangle"></i> Defunciones</th>
                            <th scope="col"><i class="fas fa-head-side-virus"></i> Casos</th>
                            <th scope="col"><i class="fas fa-exclamation-triangle"></i> Defunciones</th>
                            <th scope="col"><i class="fas fa-percentage"></i> de Letalidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                            <tr class='clickable-row' data-href='ciudades/{{strtolower($city->name)}}'>
                                <td><i class="fas fa-external-link-alt"></i> - {{$city->name}}</td>
                                <td>{{$city->getLastData('date')}}</td>
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
            <canvas id="chartBar"></canvas>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="/js/helpers.js"></script>
    <script>
        const URL_API = "{{env('APP_URL')}}/api/cities";

        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
    <script src="/js/index.js"></script>
@endsection
