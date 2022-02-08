@extends('layouts.app')

@section('content')
        <div class="col-11">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Fecha publicacion</th>
                            <th class="text-center" scope="col">Tecnico</th>
                            <th class="text-center" scope="col">Direcci&oacute;n</th>
                            <th class="text-center" scope="col">Urgente</th>
                            <th class="text-center" scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendientes as $incidencia)
                        
                            <tr style="cursor: pointer;" class="tr-enlace" data-href="{{ route('incidencias.show',$incidencia->id) }}">
                                <th scope="row">{{ $incidencia->created_at }}</th>
                                <td>{{ $incidencia->tecnico->nombre.' '.$incidencia->tecnico->apellidos }}</td>
                                <th>{{ $incidencia->ascensor->calle.' '.$incidencia->ascensor->bloque.' (Zona '.$incidencia->ascensor->zona->zona.')' }}</th>
                                
                                    <td class="text-center">
                                        @if($incidencia->urgente =="1")
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                        @else
                                            -
                                        @endif
                                    </td>
                                
                                <td>
                                    <div class="m-auto rounded-3 text-white
                                        @if( $incidencia->estado=='Pendiente' )
                                            bg-danger
                                        @elseif( $incidencia->estado=='En proceso' )
                                            bg-warning
                                        @else
                                            bg-success 
                                        @endif
                                            text-center">
                                        {{ $incidencia->estado }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if( count($resueltas)!=0 )
                        <tr>
                            <td class="text-center" colspan="5">
                                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#resueltas" aria-expanded="false" aria-controls="resueltas">    
                                Mostrar/ocultar incidencias ya resueltas
                                </button>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <table class="table table-hover collapse" id="resueltas">
                @foreach($resueltas as $incidencia)
                    <tr style="cursor: pointer;" class="tr-enlace" data-href="{{ route('incidencias.show',$incidencia->id) }}">
                        <th scope="row">{{ $incidencia->created_at }}</th>
                        <td>{{ $incidencia->tecnico->nombre.' '.$incidencia->tecnico->apellidos }}</td>
                        <th>{{ $incidencia->ascensor->calle.' '.$incidencia->ascensor->bloque.' (Zona '.$incidencia->ascensor->zona->zona.')' }}</th>
                        
                            <td class="text-center">
                                @if($incidencia->urgente =="1")
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                @else
                                    -
                                @endif
                            </td>
                        
                        <td>
                            <div class="m-auto rounded-3 text-white
                                @if( $incidencia->estado=='Pendiente' )
                                    bg-danger
                                @elseif( $incidencia->estado=='En proceso' )
                                    bg-warning
                                @else
                                    bg-success 
                                @endif
                                    text-center">
                                {{ $incidencia->estado }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $pendientes->links() !!}
        </div>
        <script>
            document.querySelectorAll('.tr-enlace').forEach(element => {
                element.addEventListener('click',() => {window.location=element.getAttribute('data-href');})
            });
        </script>
@endsection