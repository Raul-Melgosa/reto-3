<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario</title>
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        <div class="container">
            <h1>Incidencia</h1>
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
                        <input class="form-control" type="text" name="calle" id="calle" placeholder=" ">
                        <span class="p-2">Calle</span>
                    </label>
                    <label class="form-label position-relative">
                        <input class="form-control" type="text" name="numero" id="numero" placeholder=" ">
                        <span class="p-2">Numero</span>
                    </label>
                     <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Confirmar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <a href="" data-bs-dismiss="modal" aria-label="Close">hidbv8yefrg9ufwm</a>
                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-11 col-md-10 border border-light my-3"></div>
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
                <div class="col-12 col-sm-11 col-md-10  border border-light my-3"></div>
                <div class="col-11 col-md-10 ">
                    <h2>Incidencia</h2>
                
                   <div class="row "> 
                        <div class="col-11 col-lg-9 mb-3 row g-0 ms-4">     
                            <label class="form-label col-6 d-inline-block" for="select-tecnico">T&eacute;cnico</label>
                            <select class="form-label col-6 d-inline-block form-select d-inlineblock" name="tecnico" id="select-tecnico">
                                @foreach($tecnicos as $tecnico)
                                    <option value="{{ $tecnico->id }}">Nº: {{ $tecnico->id }}, {{ $tecnico->name }}, {{ $tecnico->email }} </option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-11  ms-3">     
                            <label class="form-label me-3 " for="estado" >Tivo averia</label>
                            <select name="averia" id="">
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

                        <div class="col-11  form-switch mb-3">
                            <label class="form-label col-6 d-inline-block form-check-label" for="urgente" >Urgente</label>
                            <input class="form-control col-6 d-inline-block " type="checkbox" id="urgente" name="urgente" value="true">
                        </div>

                    </div>
                </div>

                <div class="col-12 col-sm-11 col-md-10 ">
                    
                    <label for="comentarioOperador">Comentario Operador: </label>
                    <textarea class="col-12 mb-3" name="comentarioOperador" id="comentarioOperador" cols="30" rows="10"></textarea>
                    <input class="btn border mb-3" type="submit" value="Añadir">
                </div>

            </form>
        </div>
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    </body>
</html>