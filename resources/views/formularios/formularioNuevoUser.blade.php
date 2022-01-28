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
            <h1 class="mb-3">Nuevo usuario</h1>

            <form class="row justify-content-center" action="" method="post">
                
                <div  class="col-11 col-lg-10">
                <div class="rov justify-content-center">
                    
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
                </div>    
                <div class="col-11 col-lg-10">
                    <label class="position-relative">
                        <input type="text" name="" id="username" placeholder=" ">
                        <span class="p-2">Nombre de usuario</span>
                    </label>
                    <label class="position-relative">
                        <input type="text" name="" id="contrasena1" placeholder=" ">
                        <span class="p-2">Contraseña</span>
                    </label>
                    <label class="position-relative">
                        <input type="text" name="" id="contrasena2" placeholder=" ">
                        <span class="p-2">Repetir contraseña</span>
                    </label>
                
                </div>

                <div class="col-11 col-sm-11 col-lg-10 mb-3">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3  mb-3"> 
                            <p class="fs-5">Tipo de usuario</p>
                            <select name="" id=""> 
                                <option value="Operador">Operador</option>
                                <option value="Jefe Equipo">Jefe Equipo</option> 
                                <option value="Tecnico">Tecnico</option>
                            </select>
                        </div>
                        
                        
                        
                        <div class="col-12 col-sm-6 col-md-6 col-lg-8 mb-3"> 
                                <p class="fs-5">Equipo</p>
                            <!--  if(tipo usuario==jefe equipo || tipo usuario==tecnico)-->
                                <select name="" id="">
                                    
                                        <!--  foreach()-->
                                            <option value=""></option>
                                        <!--  endforeach-->
                                
                                </select> 
                            <!--  else
                            // inactivo
                                    <select name="" id="">
                                    
                                        foreach()
                                            <option value=""></option>
                                        endforeach
                                
                                </select> 
                            endif-->

                        </div>
                    </div>
                </div>

                <div class="col-11 col-sm-11 col-lg-10">
                    <input class="btn border mb-3" type="submit" value="Añadir">
                </div>

            </form>
        </div>
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    </body>
</html>