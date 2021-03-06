@extends('layouts.app')

@section('content')
  <script>
  class DatePicker extends HTMLElement {
      constructor() {
          super()
      }

      connectedCallback() {
          var hoy = new Date();
          var dia = hoy.getDate();
          var mes = hoy.getMonth() + 1;
          var anno = hoy.getFullYear();
          if (dia < 10) {
              dia = '0' + dia;
          }
          if (mes < 10) {
              mes = '0' + mes;
          }   
          hoy = anno + '-' + mes + '-' + dia;
          const shadow = this.attachShadow ({ mode: 'open'});
          shadow.innerHTML = `
          <div>
              <h5 class="titulo">Desde:</h5>
              <input type="date" name="fechaInicio" id="fechaInicio" max=`+ hoy +`>
              <h5 class="titulo">Hasta:</h5>
              <input type="date" name="fechaFin" id="fechaFin" max=`+ hoy +`>
          </div>

          <style>
              input[type="date"] {
              display:block;
              position:relative;
              padding:1rem 3.5rem 1rem 0.75rem;
              
              font-size:1rem;
              font-family:monospace;
              
              border:1px solid #8292a2;
              border-radius:0.25rem;
              background:
                white
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='22' viewBox='0 0 20 22'%3E%3Cg fill='none' fill-rule='evenodd' stroke='%23688EBB' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' transform='translate(1 1)'%3E%3Crect width='18' height='18' y='2' rx='2'/%3E%3Cpath d='M13 0L13 4M5 0L5 4M0 8L18 8'/%3E%3C/g%3E%3C/svg%3E")
                right 1rem
                center
                no-repeat;
              
              cursor:pointer;
            }
            input[type="date"]:focus {
              outline:none;
              border-color:#3acfff;
              box-shadow:0 0 0 0.25rem rgba(0, 120, 250, 0.1);
            }

            ::-webkit-datetime-edit {}
            ::-webkit-datetime-edit-fields-wrapper {}
            ::-webkit-datetime-edit-month-field:hover,
            ::-webkit-datetime-edit-day-field:hover,
            ::-webkit-datetime-edit-year-field:hover {
              background:rgba(0, 120, 250, 0.1);
            }
            ::-webkit-datetime-edit-text {
              opacity:0;
            }
            ::-webkit-clear-button,
            ::-webkit-inner-spin-button {
              display:none;
            }
            ::-webkit-calendar-picker-indicator {
              position:absolute;
              width:2.5rem;
              height:100%;
              top:0;
              right:0;
              bottom:0;
              
              opacity:0;
              cursor:pointer;
              
              color:rgba(0, 120, 250, 1);
              background:rgba(0, 120, 250, 1);
            
            }

            input[type="date"]:hover::-webkit-calendar-picker-indicator { opacity:0.05; }
            input[type="date"]:hover::-webkit-calendar-picker-indicator:hover { opacity:0.15; }    
          </style>
          `;
      }
  }

  customElements.define('date-picker',DatePicker);
</script>
    <date-picker id="fechas" class="col-12 d-flex justify-content-center"></date-picker>
    <div class="row gx-0 gy-3 my-3 col-12 col-md-6">
      <button type="button" class="btn btn-primary" id="cargarGrafica">Cargar</button>
      <select name="tipoEstadistica" class="form-select" id="tipoEstadistica"></select>
      <select name="id" class="form-select" id="id"></select>
    </div>

    <div class="col-12">
      <div id="contenedor_estadistica" style="width: 100%; height: 500px;"></div>
    </div>
    
@endsection

@section('assets')
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src=" {{ asset('js/estadisticas.js') }} "></script>
@endsection