@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">
  <div class="col-12">
    <div class="panel panel-default col-12">
      <div class="panel-heading col-12"><h3 class="text-center">Agregar archivos</h3></div>
        <div class="panel-body col-12 d-flex justify-content-center">
          <form method="POST" action="{{route('manuales.store')}}" accept-charset="UTF-8" enctype="multipart/form-data">
          @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="form-group col-12">
              <div class="col-12">
                <input type="file" required accept="application/pdf, application/vnd.ms-excel" class="form-control" name="file" >
              </div>
            </div>

            <div class="form-group col-12">
              <div class="col-12 col-md-offset-4 d-flex flex-row justify-content-evenly">
                <button type="submit" class="btn btn-primary">Subir</button>
                <button type="reset" class="btn btn-danger">Limpiar formulario</button>
                <a class="btn btn-primary" href="/manuales">Volver</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection