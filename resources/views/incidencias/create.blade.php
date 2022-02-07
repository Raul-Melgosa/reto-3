@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <div class="col-10">
            <h1 class="text-center">Incidencia</h1>
            <form class="row justify-content-center" action="{{ route('incidencia.store') }}" method="post">
                @csrf
                <div  class="col-11 col-md-10 ">
                    <h2>Cliente</h2>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="nombreCliente" id="nombreCliente" placeholder=" ">
                        <span class="p-2 ">Nombre</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="apellidoCliente" id="apellidoCliente" placeholder=" ">
                        <span class="p-2">Apellido</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="emailCliente" id="emailCliente" placeholder=" ">
                        <span class="p-2">Email</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="telefono" id="telefono" placeholder=" ">
                        <span class="p-2">Telefono</span>
                    </label>
                    <h3 class="fs-5">Direccion</h3>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="numeroserie" id="numeroserie" placeholder=" ">
                        <span class="p-2">Numero de serie</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="calle" id="calle" placeholder=" ">
                        <span class="p-2">Calle</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="numero" id="numero" placeholder=" ">
                        <span class="p-2">Numero</span>
                    </label>
                    
                    <!-- Button trigger modal -->
                    <button id="bModal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Comprobar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title col-6" id="staticBackdropLabel">Posibles ascensores</h5>
                            <h5 class="modal-title col-6" id="staticBackdropLabel">Posibles t&eacute;cnicos</h5>
                        </div>

                        <div class="modal-body row">
                            
                            <ul id="modalNumeroAscensor"class="list-group col-6">
                                
                            </ul>
                            <ul id="modalNombreTecnico" class="list-group col-6">
                                
                            </ul>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="bModalAceptar" data-bs-dismiss="modal" class="btn btn-success">Aceptar</button>
                        </div>
                        </div>
                    </div>
                    </div>

                </div>
                <div class="col-11 col-sm-11 col-md-10 border border-light my-3"></div>
                <div class="col-11 col-md-10">
                    <h2>Ascensor</h2>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="numeroSerie" id="numeroSerie" placeholder=" " disabled>
                        <span class="p-2">Numero de serie</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="modeloAscensor" id="modeloAscensor" placeholder=" " disabled>
                        <span class="p-2">Modelo</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="carga" id="carga" placeholder=" " disabled>
                        <span class="p-2">Carga (Kg)</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="recorrido" id="recorrido" placeholder=" " disabled>
                        <span class="p-2">Recorrido</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="numParadas" id="numParadas" placeholder=" " disabled>
                        <span class="p-2">Numero de paradas</span>
                    </label>
                </div>
                <div class="col-11 col-sm-11 col-md-10  border border-light my-3"></div>
                <div class="col-11 col-md-10 ">
                    <h2>Incidencia</h2>
                
                   <div class="row " id="incidencia">
                        <div class="col-11 ms-3">     
                            <label class="form-label me-3 " for="averia" >Tipo aver&iacute;a</label>
                            <select class="form-select d-inlineblock col-4" name="averia" id="averia">
                                <option value="">Sin datos</option>
                                <optgroup label="Bandalismo">
                                    <option value="Bandalismo (estético)">Est&eacute;tico</option>
                                </optgroup>
                                
                                <optgroup label="Funcionamiento">
                                    <option value="Funcionamiento (mecánico)">Mec&aacute;nico</option>
                                    <option value="Funcionamiento (eléctrico)">El&eacute;ctrico</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-check form-switch ms-5">
                            <label class="form-check-label fs-5 my-0" for="urgente">Urgente</label>
                            <input class="form-check-input" value="1" type="checkbox" id="urgente">
                        </div>

                    </div>
                </div>

                <div class="col-12 col-sm-11 col-md-10 ">
                    
                    <label for="comentarioOperador">Comentario Operador: </label>
                    <textarea class="col-12 mb-3" name="comentarioOperador" id="comentarioOperador" cols="30" rows="10"></textarea>
                    <input class="btn border mb-3" type="submit" id="btnSubmit" value="Añadir" disabled="true">
                </div>
                <input type="hidden" id="idAscensor" name="idAscensor">
                <input type="hidden" id="idTecnico" name="idTecnico">
            </form>
        </div>
       <!-- <script src="{{ asset('js/jquery-3.5.1.js') }}" ></script>-->
        <script src="{{ asset('js/direccionAscensores.js') }}" ></script>
@endsection         