<style>
    .toast{
        width: 400px;
    }
    .toast .toast-header img{
        width:25px;
    }
    .toast .toast-header strong{
        font-size: 15px;
        font-weight: 700;
        color: black
    }
</style>

@if (Session::has('message'))
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="position: absolute; top: 100px; right: 25px;">
    <div class="toast-header">
        <img src="/img/favicon.png" class="rounded mr-2" alt="...">
        <strong class="mr-auto">Sonora Covid</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        {{ Session::get('message') }}
    </div>
</div>
@endif

@section('js')
    <script>
        $('.toast').toast('show')
    </script>
@endsection
