@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-center">
    <h1 class="text-center">Hola {{ auth()->user()->nombre }}, tienes el rol de Jefe De equipo</h1>
</div>

@endsection