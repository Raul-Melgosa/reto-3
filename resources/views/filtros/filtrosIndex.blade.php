@extends('layouts.app')

@section('content')
        <div class="col-11">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Fecha publicacion</th>
                        <th class="text-center" scope="col">Tecnico</th>
                        <th class="text-center" scope="col">Zona</th>
                        <th class="text-center" scope="col">Urgente</th>
                        <th class="text-center" scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incidencias as $incidencia)
                        <tr>
                            <th scope="row">{{ $incidencia->created_at }}</th>
                            <td>{{ $incidencia->tecnico->nombre.' '.$incidencia->tecnico->apellidos }}</td>
                            <th scope="row">{{ $incidencia->ascensor->zona->zona }}</th>
                            
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
                            <td>
                                <a href="{{ route('filtros.show',$incidencia->id) }}"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Mas iformation</title><path d="M248 64C146.39 64 64 146.39 64 248s82.39 184 184 184 184-82.39 184-184S349.61 64 248 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M220 220h32v116"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M208 340h88"/><path d="M248 130a26 26 0 1026 26 26 26 0 00-26-26z"/></svg></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection