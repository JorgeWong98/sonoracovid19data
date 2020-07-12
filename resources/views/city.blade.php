@extends('layouts.public')

@section('styles')
    <link rel="stylesheet" href="/css/city.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <p>
                    Datos de la ciudad de
                    <select class="form-control" style="width: auto; display:inline-block" id="city">
                        <option value="1" selected>Nogales</option>
                        <option value="2">Hermosillo</option>
                    </select>
                    .
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
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="/js/helpers.js"></script>
    <script src="/js/city.js"></script>
@endsection
