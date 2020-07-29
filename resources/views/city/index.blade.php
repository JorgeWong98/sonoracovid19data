@extends('layouts.public')

@section('styles')
    <link rel="stylesheet" href="/css/index.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="find-city" class="form-inline find-city">
                <p>
                    Consulta los datos de una ciudad en específico:
                </p>
                <div class="form-group">
                    <input class="form-control mr-2" type="search" placeholder="Ingrese una ciudad" aria-label="Search" id="tags">
                    <button class="btn btn-primary" type="submit" id="btn_find_city">Buscar</button>
                </div>
            </div>
            <br>
            <p class="text">
                Últimos datos y acumulados de las ciudades de Sonora. Se está trabajando para incluir el resto de ciudades del estado.
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
                            <td>{{$city->name}}</td>
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
                <p class="caption">
                    Puede acceder a los datos de cada ciudad dando clic en su respectivo registro.
                </p>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sonora Covid</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a>La ciudad que intenta buscar no se encuentra en nuestro sistema.</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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

        var cities = {!! json_encode($cities, JSON_HEX_TAG) !!};

        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
    <script src="/js/index.js"></script>
    <script src="/js/city_find.js"></script>
@endsection
