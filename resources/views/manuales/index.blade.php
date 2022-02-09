@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <div class="row justify-content-center">
                <div class="mb-3">
                    <input type="text" placeholder="Buscar" class="form-control mb-2" name="buscarAscensor" id="buscarAscensor">
                    <input type="button" class="btn btn-primary mb-2" value="Filtrar" id="filtrar">
                    @if(Auth::user()->rol=='jde'||Auth::user()->rol=='admin')
                        <a class="btn btn-primary w-100" href="{{ route('manuales.create') }}">Subir manuales</a>
                    @endif
                </div>
                <div class="accordion" id="acordeonManuales">
                    @foreach($manuales as $manual)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $manual->id }}">
                            
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $manual->id }}" aria-expanded="true" aria-controls="collapse{{ $manual->id }}">
                                {{ $manual->modelo }}
                            </button>
                        </h2>
                        <div id="collapse{{ $manual->id }}" class="accordion-collapse collapse  "  data-bs-parent="#acordeonManuales">
                            <div class="accordion-body">

                                <iframe src="{{ asset('storage/manuales/') }}{{'/'.$manual->manual}}" width="100%" height="400vh"></iframe>
                            </div>
                        </div>
                    </div>
                        
                    @endforeach
                </div>
                <a class="mt-3 btn btn-primary mb-3 col-4" href="{{ url()->previous() }}">Volver</a>
                    <input type="hidden" name="" value="{{ asset('storage/manuales/') }}" id="ruta">
            </div>            
            <script src="{{ asset('js/filtrarManualAscensores.js') }}" ></script>

@endsection
