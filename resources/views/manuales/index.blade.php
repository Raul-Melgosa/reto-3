@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <div class="row justify-content-center">
                <input type="text" name="buscarAscensor" id="buscarAscensor">
                <input type="button" value="Filtrar" id="filtrar">
                @foreach($manuales as $manual)
                    <div class="col-11 col-sm-6">
                        <iframe src="{{ asset('storage/manuales/') }}{{'/'.$manual->manual}}" width="75%" height="400vh"></iframe>
                    </div>
                @endforeach
                
            </div>
            <script src="{{ asset('js/filtrarManualAscensores.js') }}" ></script>
@endsection
