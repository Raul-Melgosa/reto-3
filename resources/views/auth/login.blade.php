@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-10 row m-auto shadow mb-5 bg-body rounded">
        <div class="position-fixed p-2">Ascensores Igobide</div>
        <div class="col-6 d-none d-sm-block text-center g-0"><img style="max-width: 100%; overflow:hidden;" src="{{ asset('img/login-pcs.svg') }}" alt=""></div>
        <div class="col-12 col-sm-6 row g-0 text-center">
            
            <form class="col-10 m-auto justify-content-center" action="{{ route('login') }}" method="POST">
                @csrf
                <h3 class="display-6 mb-3">Bienvenido</h3>
                <div class="row mb-2 justify-content-center"><!--Nombre de usuario-->
                    <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Nombre de usuario') }}</label>

                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2 justify-content-center"><!--Contraseña-->
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2"><!--Recordarme-->
                    <div class="form-check m-auto w-auto">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label my-0" for="remember">
                            {{ __('Recordarme') }}
                        </label>
                    </div>
                    
                </div>

                <div class="row mb-2 justify-content-center">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link w-auto" href="{{ route('password.request') }}">
                            {{ __('Olvidé mi contraseña') }}
                        </a>
                    @endif
                </div>

                <div class="row mb-2 justify-content-center">
                    <button type="submit" class="btn btn-primary w-50">
                        {{ __('Iniciar sesión') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<!--Formulario

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label my-0" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
-->