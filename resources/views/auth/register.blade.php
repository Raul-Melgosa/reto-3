@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
<img class="position-absolute m-auto" style="max-width: 100%; max-height: 100vh; top:0px; z-index: -1;" src="{{asset('/img/Abstract-3d-art-background.png')}}" alt="">
    <div class="col-md-7 col-sm-8 col-11 row justify-content-center align-items-center m-auto shadow mb-5 rounded">
                    <form class="col-12 m-auto justify-content-center bg-light py-5 rounded" style="--bs-bg-opacity: .6;" method="POST" action="{{ route('crearUsuario') }}">
                        @csrf
                        <h1 class="text-center"><b>Registrar Usuarios</b></h1>
                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end"><b>{{ __('Nombre de usuario') }}</b></label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end"><b>{{ __('Nombre') }}</b></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="apellidos" class="col-md-4 col-form-label text-md-end"><b>{{ __('Apellidos') }}</b></label>

                            <div class="col-md-6">
                                <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus>

                                @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end"><b>{{ __('Email') }}</b></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end"><b>{{ __('Contraseña') }}</b></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end"><b>{{ __('Confirmar contraseña') }}</b></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="rol" class="col-md-4 col-form-label text-md-end"><b>{{ __('Rol') }}</b></label>

                            <div class="col-md-6">
                                <select name="rol" id="rol" class="form-select">
                                    @if(auth()->user()->rol!='jde')
                                    <option value="operador">Operador/a</option>
                                    <option value="jde">Jefe de equipo</option>
                                    @endif
                                    <option value="tecnico">T&eacute;cnico</option>
                                    
                                </select>
                            </div>
                        </div>
                        @if(auth()->user()->rol=='admin')
                        <div class="row mb-3">
                            <label for="equipo" class="col-md-4 col-form-label text-md-end"><b>{{ __('Equipo') }}</b></label>

                            <div class="col-md-6">
                                <select name="equipo_id" id="equipo" class="form-select">
                                    @foreach($equipos as $equipo)
                                        <option value="{{ $equipo->id }}">Equipo {{ $equipo->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="equipo" class="col-md-4 col-form-label text-md-end"><b>{{ __('Zona del equipo') }}</b></label>

                            <div class="col-md-6">
                                <select name="zona" id="rol" class="form-select">
                                    @foreach($zonas as $zona)
                                        <option value="{{ $zona->id }}"> {{ $zona->zona }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
</div>
@endsection
