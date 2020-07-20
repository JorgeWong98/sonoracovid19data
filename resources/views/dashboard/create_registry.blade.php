@extends('layouts.public')

@section('styles')
    <style>
        table.table .name_city{
            min-width: 200px;
        }

        table.table input.form-control{
            width:40%;
            text-align: center;
            margin: 0 auto;
        }

        form{
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Nuevo registro</h2>
            <form action="{{url('dashboard/registro/crear')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Fecha: 19/07/2020</label>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="name_city" scope="col">Ciudad</th>
                            <th scope="col">Infectados</th>
                            <th scope="col">Defunciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                            <tr>
                                <td>{{$city->name}}</td>
                                <td>
                                    <input type="text" name="{{$city->id}}[]" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="{{$city->id}}[]" class="form-control">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="btn btn-primary" type="submit">Aceptar</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        const inputs_text = document.getElementsByClassName('form-control');

        Array.prototype.forEach.call(inputs_text, function(item) {
            item.addEventListener('keypress', (e) => {
                validate(e);
            })
        });

        function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
    </script>
@endsection
