@extends('layouts.app')

@section('content')
<div class="container">
<img class="position-absolute" style="max-width: 100%; max-height: 100vh; top:0px; z-index: -1;" src="{{asset('/img/Abstract-3d-art-background.png')}}" alt="">
    <div class="col-6 row justify-content-center align-items-center m-auto shadow mb-5 rounded">
        <form class="col-12 m-auto justify-content-center" action="{{ route('login') }}" method="POST">
            @csrf
            <h3 class="display-6 mb-3 text-center fw-bold">Bienvenido</h3>
            <div class="row mb-2 justify-content-center"><!--Nombre de usuario-->
                <label for="username" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Nombre de usuario') }}</label>

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
                <label for="password" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Contraseña') }}</label>

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
                    <label class="form-check-label my-0 fw-bold" for="remember">
                        {{ __('Recordarme') }}
                    </label>
                </div>
                
            </div>

            <div class="row mb-2 justify-content-center">
                @if (Route::has('password.request'))
                    <a class="btn btn-link w-auto fw-bold" href="{{ route('password.request') }}">
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
@endsection