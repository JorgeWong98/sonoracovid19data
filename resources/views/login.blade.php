@extends('layouts.public')

@section('styles')
<link rel="stylesheet" href="/css/login.css">
@endsection

@section('content')
<div class="wrapper">
    <form action="{{url('/login')}}" method="post" class="form-signin">
        @csrf
        <a class="form-signin-heading">Inicio de sesión</a>
        <hr>
        <input type="text" class="form-control" name="email" placeholder="Correo electronico" required="" />
        <input type="password" class="form-control" name="password" placeholder="Contraseña" required=""/>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
    </form>
</div>
@endsection
