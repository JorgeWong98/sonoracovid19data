@extends('layouts.public')

@section('styles')
    <link rel="stylesheet" href="/css/data.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Datos Covid-19 Sonora</h2>
                <p>Numero de contagios de los ultimos 7 días.</p>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Nogales',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [0, 10, 5, 2, 20, 30, 45]
            },
            {
                label: 'Hermosillo',
                backgroundColor: 'rgb(70, 85, 132)',
                borderColor: 'rgb(70, 85, 132)',
                data: [5, 15, 15, 13, 25, 40, 55]
            },
            ]
        },
    });
</script>
@endsection
