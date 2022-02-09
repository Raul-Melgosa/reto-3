<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>IgobideApp</title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/jquery-3.6.0.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('assets'); ?>
    
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    
</head>
<body>
    <div id="app gx-0">
        <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top col-12" style="--bs-bg-opacity: .8;">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    IgobideApp
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#layoutNavbar" aria-controls="layoutNavbar" aria-expanded="false" aria-label="Mostrar más">
                    <p class="navbar-toggler-icon m-0"></p>
                </button>

                <div class="collapse navbar-collapse" id="layoutNavbar">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(auth()->user()->rol=='operador'): ?>
                            <li class="nav-item">
                                <a class="btn btn-primary" href="<?php echo e(route('incidencia.create')); ?>">
                                        <?php echo e(__('Nueva incidencia')); ?>

                                    </a>
                            </li>
                            <?php else: ?>
                            <li class="nav-item">
                                <a class="btn btn-link" href="/manuales"> <!--Con route('manuales.index') no estaba funcionando-->
                                        <?php echo e(__('Manuales')); ?>

                                    </a>
                            </li>
                            <?php endif; ?>
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo e(Auth::user()->email); ?>

                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php if(Auth::user()->rol=='jde' || Auth::user()->rol=='admin'): ?>
                                    <li>
                                        <a class="dropdown-item" href="#">Registrar usuarios</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#modalRol" data-bs-toggle="modal" data-bs-target="#modalRol">
                                            Cambiar de rol
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <?php endif; ?>
                                    
                                    <li>
                                        <a class="dropdown-item " href="<?php echo e(route('logout')); ?>"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            <?php echo e(__('Cerrar sesión')); ?>

                                        </a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
<?php if(auth()->guard()->check()): ?>
        <div class="modal fade" id="modalRol" tabindex="-1" aria-labelledby="modalRolLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRolLabel">Selecciona un rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    <li class="list-group-item border-0 p-0 my-1">
                        <input type="radio" class="btn-check" name="roles" id="inputAdmin" autocomplete="off" value="admin"
                        <?php if(Auth::user()->rol=='admin'): ?>
                            checked
                        <?php endif; ?>
                        >
                        <label class="btn btn-outline-primary text-center m-0 w-100" for="inputAdmin">Admin</label>
                    </li>

                    <li class="list-group-item border-0 p-0 my-1">
                        <input type="radio" class="btn-check" name="roles" id="inputJde" autocomplete="off" value="jde"
                        <?php if(Auth::user()->rol=='jde'): ?>
                            checked
                        <?php endif; ?>
                        >
                        <label class="btn btn-outline-primary text-center m-0 w-100" for="inputJde">Jefe de Equipo</label>
                    </li>

                    <li class="list-group-item border-0 p-0 my-1">
                        <input type="radio" class="btn-check" name="roles" id="inputTecnico" autocomplete="off" value="tecnico"
                        <?php if(Auth::user()->rol=='tecnico'): ?>
                            checked
                        <?php endif; ?>
                        >
                        <label class="btn btn-outline-primary text-center m-0 w-100" for="inputTecnico">T&eacute;cnico</label>
                    </li>

                    <li class="list-group-item border-0 p-0 my-1">
                        <input type="radio" class="btn-check" name="roles" id="inputOperador" autocomplete="off" value="operador"
                        <?php if(Auth::user()->rol=='admin'): ?>
                            operador
                        <?php endif; ?>
                        >
                        <label class="btn btn-outline-primary text-center m-0 w-100" for="inputOperador">Operador</label>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Aplicar</button>
            </div>
            </div>
        </div>
        </div>
<?php endif; ?>
        
        <div class="separador"></div>

        <main class="py-4 row justify-content-center gx-0">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
<?php /**PATH /home/vagrant/code/reto-3/resources/views/layouts/app.blade.php ENDPATH**/ ?>