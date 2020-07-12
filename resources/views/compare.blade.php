@extends('layouts.public')

@section('content')
<div class="container">
    <div class="row">
        <div id="graph-container-compare" class="col-md-10">
            <p>
                Comparacion entre las ciudades
                <select class="form-control" style="width: auto; display:inline-block" id="city">
                    <option value="1" selected>Nogales</option>
                </select>
                y
                <select class="form-control" style="width: auto; display:inline-block" id="city">
                    <option value="2" selected>Hermosillo</option>
                </select>
                .
            </p>
            <p>
                Periodo: Últimos
                <select class="form-control" style="width: auto; display:inline-block" id="period_compare">
                    <option value="7" selected>7 días</option>
                    <option value="14">14 días</option>
                    <option value="31">31 días</option>
                </select>
                .
                Comparar:
                <select class="form-control" style="width: auto; display:inline-block" id="type_compare">
                    <option value="0" selected>Infectados</option>
                    <option value="1">Defunciones</option>
                </select>
            </p>
            <canvas id="chartLine"></canvas>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="/js/helpers.js"></script>
    <script src="/js/compare.js"></script>
@endsection
