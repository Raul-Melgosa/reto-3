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
            <form class="row justify-content-center" action="" method="post">
                
                <div  class="col-12 col-sm-11 col-md-10 ">
                    <h2>Cliente</h2>
                    <label class="position-relative">
                        <input type="text" name="" id="nombreCliente" placeholder=" ">
                        <span class="p-2 ">Nombre</span>
                    </label>
                    <label class="position-relative">
                        <input type="text" name="" id="apellidoCliente" placeholder=" ">
                        <span class="p-2">Apellido</span>
                    </label>
                    <label class="position-relative">
                        <input type="text" name="" id="emailCliente" placeholder=" ">
                        <span class="p-2">Email</span>
                    </label>
                    <label class="position-relative">
                        <input type="text" name="" id="telefono" placeholder=" ">
                        <span class="p-2">Telefono</span>
                    </label>
                    <h3 class="fs-5">Direccion</h3>
                    <label class="position-relative">
                        <input type="text" name="" id="calle" placeholder=" ">
                        <span class="p-2">Calle</span>
                    </label>
                    <label class="position-relative">
                        <input type="text" name="" id="numero" placeholder=" ">
                        <span class="p-2">Numero</span>
                    </label>
                </div>
                <div class="col-12 col-sm-11 col-md-10 border border-light "></div>
                <div class="col-12 col-sm-11 col-md-10 ">
                    <h2>Ascensor</h2>
                    <label class="position-relative">
                        <input type="text" name="" id="numeroSerie" placeholder=" " disabled>
                        <span class="p-2">Numero de serie</span>
                    </label>
                    <label class="position-relative">
                        <input type="text" name="" id="modeloAscensor" placeholder=" " disabled>
                        <span class="p-2">Modelo</span>
                    </label>
                    <label class="position-relative">
                        <input type="text" name="" id="carga" placeholder=" " disabled>
                        <span class="p-2">Carg (Kg)</span>
                    </label>
                    <label class="position-relative">
                        <input type="text" name="" id="recorrido" placeholder=" " disabled>
                        <span class="p-2">Recorrido</span>
                    </label>
                    <label class="position-relative">
                        <input type="text" name="" id="numParadas" placeholder=" " disabled>
                        <span class="p-2">Numero de paradas</span>
                    </label>
                </div>
                <div class="col-12 col-sm-11 col-md-10  border border-light "></div>
                <div class="col-12 col-sm-11 col-md-10  mb-3">
                    <h2>Incidencia</h2>
                    <select class="form-select" placeholder="Técnico" name="" id="">
                        <!-- 
                            foreach()
                                <option value=""></option>
                            endforeach
                        -->
                    </select>
                    
                </div>

                <div class="col-12 col-sm-11 col-md-10 ">
                   <div class="row justify-content-center"> 
                       <div class="col-6 col-sm-6 col-md-5 col-lg-4  mb-3">
                            <label class="me-3 " for="urgencia" >Urgente:  </label>
                            <input type="radio" id="urgenciaSi" name="urgencia" value="si">
                            <label for="urgenciaSi">Si</label>
                            <input type="radio" id="urgenciaNo" name="urgencia" value="no">
                            <label for="urgenciaNo">No</label>
                        </div>  
                        <div class="col-6 col-sm-6 col-md-5 col-lg-4  mb-3">     
                            <label class="me-3 " for="estado" >Estado:  </label>
                            <select name="" id="">
                                <option value="Sin Estado">Sin Estado</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="Finalizado">Finalizado</option>
                            </select>
                        </div> 
                    </div>
                </div>

                <div class="col-12 col-sm-11 col-md-10 ">
                    
                    <label for="comentarioOperador">Comentario Operador: </label>
                    <textarea class="col-12 mb-3" name="" id="comentarioOperador" cols="30" rows="10"></textarea>
                    <input class="btn border mb-3" type="submit" value="Añadir">
                </div>

            </form>
        </div>
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    </body>
</html>