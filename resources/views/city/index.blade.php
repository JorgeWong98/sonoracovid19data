@extends('layouts.public')

@section('styles')
    <link rel="stylesheet" href="/css/index.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="text">
                Ultimos datos y acumulados de las ciudades de Sonora. <br>
                Se esta trabajando para incluir las demas ciudades de Sonora.
            </p>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th colspan="1"></th>
                        <th colspan="3">Nuevos</th>
                        <th colspan="3">Acumulado</th>
                    </tr>
                    <tr>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Casos</th>
                        <th scope="col">Defunciones</th>
                        <th scope="col">Casos</th>
                        <th scope="col">Defunciones</th>
                        <th scope="col">Letalidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                        <tr class='clickable-row' data-href='ciudades/{{strtolower($city->name)}}'>
                            <td>{{$city->name}}</td>
                            <td>{{$city->registries[0]->getFormattedDate('d/F')}}</td>
                            <td>{{$city->registries[0]->infections}}</td>
                            <td>{{$city->registries[0]->deaths}}</td>
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
            <p class="text">
                Gráfica comparativa.
            </p>
            <canvas id="chartBar"></canvas>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script>
        var cities = {!! json_encode($cities->toArray(), JSON_HEX_TAG) !!};
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
    <script src="/js/index.js"></script>
@endsection
