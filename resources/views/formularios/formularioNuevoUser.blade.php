<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('js/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        <div class="container">
            <h1 class="mb-3">Nuevo usuario</h1>
            <form class="row justify-content-center" action="" method="post">
                @csrf
                <div  class="col-10 ">
                    <label class="form-label position-relative">
                        <input type="text" name="" id="nombreCliente" placeholder=" ">
                        <span class="p-2 ">Nombre</span>
                    </label>
                    <label class="form-label position-relative">
                        <input type="text" name="" id="apellidoCliente" placeholder=" ">
                        <span class="p-2">Apellido</span>
                    </label>
                    <label class="form-label position-relative">
                        <input type="text" name="" id="emailCliente" placeholder=" ">
                        <span class="p-2">Email</span>
                    </label>
                </div>    
                <div class="col-10">
                    <label class="form-label position-relative">
                        <input type="text" name="" id="username" placeholder=" ">
                        <span class="p-2">Nombre de usuario</span>
                    </label>
                    <label class="form-label position-relative">
                        <input type="text" name="" id="contrasena1" placeholder=" ">
                        <span class="p-2">Contraseña</span>
                    </label>
                    <label class="form-label position-relative">
                        <input type="text" name="" id="contrasena2" placeholder=" ">
                        <span class="p-2">Repetir contraseña</span>
                    </label>
                
                </div>

                <div class="col-10  mb-3">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-5 col-lg-4  mb-3"> 
                            <p class="fs-5">Tipo de usuario</p>
                            <select name="" id="">
                                <!-- 
                                    foreach()
                                        <option value=""></option>
                                    endforeach
                                -->
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-5 col-lg-4 mb-3"> 
                            <p class="fs-5">Tipo de usuario</p>
                            <select name="" id="">
                                <!-- 
                                    foreach()
                                        <option value=""></option>
                                    endforeach
                                -->
                            </select>
                        </div>
                        <!-- 
                            if()
                                <div class="col-6"> 
                                    <p class="fs-5">Equipo</p>
                                    <select name="" id="">
                                        
                                            foreach()
                                                <option value=""></option>
                                            endforeach
                                    
                                    </select>
                                </div>
                            endif
                        -->
                    </div>

                </div>
                <div class="col-10 ">
                    <input class="btn border mb-3" type="submit" value="Añadir">
                </div>

            </form>
        </div>
    </body>
</html>