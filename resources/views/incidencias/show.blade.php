@extends('layouts.app')

@section('content')
            <div class="row justify-content-center">
                <div  class="col-11 col-md-10 ">
                    <h1>Descripcion de la incidencia</h1>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Fecha publicacion </th>
                                <th scope="col">Zona</th>
                                <th scope="col">Urgente</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <th scope="row">{{ $incidencia->created_at }}</th>
                                    <td>{{ $incidencia->ascensor->zona->zona }}</td>

                                    @if($incidencia->urgente =="0")
                                        <td>-</td>
                                    @else
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                        </td>
                                    @endif

                                    <td>{{ $incidencia->estado }}</td>
                                    <td>
                                        <a href="{{ url()->previous() }}">Volver</a>
                                    </td>
                                </tr>
                                
                        </tbody>
                    </table>

                    <h2>Cliente</h2>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" value="{{ $incidencia->cliente->nombre }}" name="nombreCliente" id="nombreCliente" placeholder=" " disabled>
                        <span class="p-2 ">Nombre</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" value="{{ $incidencia->cliente->apellido }}" name="apellidoCliente" id="apellidoCliente" placeholder=" " disabled>
                        <span class="p-2">Apellido</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" value="{{ $incidencia->cliente->email }}" name="emailCliente" id="emailCliente" placeholder=" " disabled>
                        <span class="p-2">Email</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" value="{{ $incidencia->cliente->telefono }}" name="telefono" id="telefono" placeholder=" " disabled>
                        <span class="p-2">Telefono</span>
                    </label>
                    <h3 class="fs-5">Direccion</h3>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" value="{{ $incidencia->ascensor->calle }}" name="calle" id="calle" placeholder=" " disabled>
                        <span class="p-2">Calle</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" value="{{ $incidencia->ascensor->bloque }}" name="numero" id="numero" placeholder=" " disabled>
                        <span class="p-2">Numero</span>
                    </label>
                </div>
                <div class="col-11 col-sm-11 col-md-10 border border-light my-3"></div>
                <div class="col-11 col-md-10">
                    <h2>Ascensor</h2>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" value="{{ $incidencia->ascensor->numeroserie }}" name="numeroSerie" id="numeroSerie" placeholder=" " disabled>
                        <span class="p-2">Numero de serie</span>
                    </label>

                    <label class="form-label position-relative">
                        <input class="form-control" type="text"  name="modeloAscensor" value="{{ $modelo->modelo }}" id="modeloAscensor" placeholder=" " disabled>
                        <span class="p-2">Modelo</span>
                    </label>

                    <label class="form-label position-relative">
                        <input class="form-control" type="text" value="{{ $modelo->carga.' Kg' }}" name="carga" id="carga" placeholder=" " disabled>
                        <span class="p-2">Carga</span>
                    </label>

                    <label class="form-label position-relative">
                        <input class="form-control" type="text" value="{{ $incidencia->ascensor->recorrido.' metros' }}" name="recorrido" id="recorrido" placeholder=" " disabled>
                        <span class="p-2">Recorrido</span>
                    </label>

                    <label class="form-label position-relative">
                        <input class="form-control" type="text" value="{{ $incidencia->ascensor->paradas }}"  name="numParadas" id="numParadas" placeholder=" " disabled>
                        <span class="p-2">Numero de paradas</span>
                    </label>
                    <div>
                        <!--
                        {{ asset('storage/manuales/') }}{{'/'.$modelo->manual}} = direccion donde estan los manuales
                        -->
                        <iframe src="{{ asset('storage/manuales/') }}{{'/'.$modelo->manual}}" width="75%" height="650vh"></iframe>
                    </div>
                </div>
                <div class="col-11 col-sm-11 col-md-10  border border-light my-3"></div>
                <form action="{{ route('incidencias.update',$incidencia->id) }}" method="post">  
                    @csrf
                    @method("PUT")
                    <div class="col-11 col-md-10 ">
                        <h2 class="mb-5">Incidencia</h2>
                        @if(auth()->user()->rol=='operador')
                            <div class="col-12 col-sm-11 col-lg-9 mb-3 row g-0 ms-4">     
                                <label class="form-label position-relative">
                                    <input class="form-control" type="text" value="{{ $incidencia->tecnico->nombre.' '.$incidencia->tecnico->apellidos }}, {{ $incidencia->tecnico->email }} " name="numeroSerie" id="numeroSerie" placeholder=" " disabled>
                                    <span class="p-2">T&eacute;cnico</span>
                                </label>
                            </div> 
                        @endif

                            @if(auth()->user()->rol=='jde')
                            
                            <div class="col-12 col-sm-11 col-lg-9 mb-3 row g-0 ms-4">     
                                <label for="teccnicos">T&eacute;cnicos</label>
                                <select class="form-select" name="tecnicos" id="tecnicos">
                                    @foreach($tecnicos as $tecnico)
                                        @if($incidencia->tecnico->id == $tecnico->id)
                                            <option value="{{$tecnico->id}}" selected>
                                        @else
                                            <option value="{{$tecnico->id}}">
                                        @endif
                                            {{ $tecnico->nombre.' '.$tecnico->apellidos.', '.$tecnico->email }}
                                        </option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                            @endif
                        </div>
                    </div>

                    <div class="col-11 col-sm-11 col-md-10 ">
                        
                        <label for="comentarioOperador">Comentario Operador: </label>
                        <textarea class="col-12 mb-3" name="comentarioOperador" id="comentarioOperador" cols="30" rows="10" disabled>{{ $incidencia->comentarioOperador }}</textarea>

                        <label for="comentarioTecnico">Comentario Tecnico: </label>
                        @if(auth()->user()->rol=='tecnico') 
                            <textarea class="col-12 mb-3" name="comentarioTecnico" id="comentarioTecnico" cols="30" rows="10">{{  $incidencia->comentarioTecnico }}</textarea>
                            <div class="col-11 ms-3">     
                                <label class="form-label me-3 " for="averia" >Tipo aver&iacute;a</label>
                                <select class="form-select d-inlineblock col-4" name="averia" id="averia">
                                    <optgroup label="Bandalismo">
                                        <option value="Bandalismo (estético)">Est&eacute;tico</option>
                                    </optgroup>
                                    
                                    <optgroup label="Funcionamiento">
                                        <option value="Funcionamiento (mecánico)">Mec&aacute;nico</option>
                                        <option value="Funcionamiento (eléctrico)">El&eacute;ctrico</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-11 ms-3">     
                                <label class="form-label me-3 " for="estado" >Estado</label>
                                <div class="col-4">
                                    @if($incidencia->estado=='Pendiente')
                                        <input type="radio" class="btn-check" name="estados" id="pendiente" autocomplete="off" value="pendiente" checked>
                                    @else
                                        <input type="radio" class="btn-check" name="estados" id="pendiente" autocomplete="off" value="pendiente">
                                    @endif
                                    <label class="btn btn-outline-danger m-0 w-100" for="pendiente">Pendiente</label>
                                </div>

                                <div class="col-4">
                                    @if($incidencia->estado=='En Proceso')
                                        <input type="radio" class="btn-check" name="estados" id="proceso" autocomplete="off" value="En proceso" checked>
                                    @else
                                        <input type="radio" class="btn-check" name="estados" id="proceso" autocomplete="off" value="En proceso">
                                    @endif
                                    <label class="btn btn-outline-warning m-0 w-100" for="proceso">En proceso</label>
                                </div>

                                <div class="col-4">
                                    @if($incidencia->estado=='Resuelta')
                                        <input type="radio" class="btn-check" name="estados" id="resuelta" autocomplete="off" value="resuelta" checked>
                                    @else
                                        <input type="radio" class="btn-check" name="estados" id="resuelta" autocomplete="off" value="resuelta">
                                    @endif
                                    <label class="btn btn-outline-success m-0 w-100" for="resuelta">Resuelta</label>
                                </div>
                            </div>
                            <input type="hidden" name="cliente" value="{{ $incidencia->cliente->id }}">
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                        @else
                            <textarea class="col-12 mb-3" name="comentarioTecnico" id="comentarioTecnico" cols="30" rows="10" disabled>{{ $incidencia->comentarioTecnico }}</textarea>
                        @endif
                    
                    <button class="btn border mb-3"><a href="{{ url()->previous() }}">Volver</a></button>
                </div>   
            
                </form>
            </div>
@endsection
