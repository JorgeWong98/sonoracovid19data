<div id="container-alert">
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Lista de errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
        </div>
    @endif
</div>

@section('styles')
    <style>
        .alert.alert-danger {
            width: 90%;
            margin: 15px auto;
        }

        .alert.alert-danger ul {
            padding-left: 35px;
        }
    </style>
@endsection
