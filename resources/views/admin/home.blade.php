@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-center">
    <h1 class="text-center">Hola {{ auth()->user()->nombre }}, tienes el rol de Administrador</h1>
</div>

@endsection