@extends('layouts.public')

@section('styles')
<style>
    div.info{
        text-align: center;
        font-size: 35px;
        font-family: 'Roboto', sans-serif;
    }
    div.info span{
        display: block;
    }
    div.info span:nth-child(2) a{
        font-size: 20px;
        text-decoration: none;
    }
</style>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 info">
                <span>
                    <i class="fas fa-search"></i> Pagina solicitada no encontrada.
                </span>
                <span>
                    <a href="/"><i class="fas fa-undo"></i> Volver al inicio.</a>
                </span>
            </div>
        </div>
    </div>
@endsection
