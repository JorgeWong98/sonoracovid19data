@extends('layouts.public')

@section('styles')
    <style>
        form .row .date{
            display: flex;
            align-items: baseline;
        }

        form .row .date label{
            font-weight: 700;
            font-size: 17px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Ver Registros</h2>
                <br>
                <form action="{{url('dashboard/registro')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group row col-md-10 date">
                            <label class="col-md-2" for="">Fecha:</label>
                            <div class="col-md-10">
                                <input name="date" type="date" class="form-control" value="{{isset($date) ? $date : ''}}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input class="btn btn-primary" type="submit" value="Buscar">
                        </div>
                    </div>
                </form>
                @isset($cities)
                    <h2>Registros capturados</h2>
                    <form action="{{url('dashboard/registro/crear')}}" method="post">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="name_city" scope="col">Ciudad</th>
                                    <th scope="col">Infectados</th>
                                    <th scope="col">Defunciones</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cities as $city)
                                <tr>
                                    <td>{{$city->name}}</td>
                                    <td><input disabled="disabled" type="text" class="form-control" value="{{$city->infections}}"></td>
                                    <td><input disabled="disabled" type="text" class="form-control" value="{{$city->deaths}}"></td>
                                    <td>
                                        {{-- <a href="{{url("dashboard/registro/$city->registry")}}">Editar</a>
                                        <a href="#">Eliminar</a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-primary" type="submit">Aceptar</button>
                    </form>
                @endisset
            </div>
        </div>
    </div>
@endsection
