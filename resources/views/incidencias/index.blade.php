@extends('layouts.app')

@section('assets')
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
            <script type="text/javascript" src=" {{ asset('js/filtro.js') }} "></script>
@endsection

@section('content')
        <div class="accordion" id="accordionFlush">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Filtros
                </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlush">
                <div class="accordion-body">
                    <div id="filtros" class="d-flex flex-column col-12 justify-content-center align-items-center">
                        <date-picker id="fechas" class="col-12 d-flex justify-content-center"></date-picker>
                        <div class="row gx-0 gy-3 my-3 col-12 col-md-6">
                            <label for="inputNombre">Nombre técnico:</label>
                            <input class="form-control" type="text" id="inputNombre" name="inputNombre" value="{{ request('nombre') }}"/>
                            <label for="selectZonas">Zona:</label>
                            <select class="form-select" id="selectZonas" name="selectZonas">
                                <option selected value="undefined">--Selecciona una zona--</option>
                                <option value="norte">norte</option>
                                <option value="sur">sur</option>
                                <option value="este">este</option>
                                <option value="oeste">oeste</option>
                                <option value="centro">centro</option>
                            </select>
                            <label for="selectEstado">Estados:</label>
                            <select class="form-select" id="selectEstado" name="selectEstado">
                                <option value="undefined">--Estado--</option>
                                <option value="En proceso">En proceso</option>
                                <option value="Resuelta">Resuelta</option>
                                <option value="Pendiente">Pendiente</option>
                            </select>
                            <button type="button" class="btn btn-primary" id="bFiltar">Filtrar</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-11">
        <div class="col-12">
            <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Fecha publicacion</th>
                        <th class="text-center" scope="col">Tecnico</th>
                        <th class="text-center" scope="col">Zona</th>
                        <th class="text-center" scope="col">Urgente</th>
                        <th class="text-center" scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incidencias as $incidencia)
                      
                        <tr style="cursor: pointer;" class="tr-enlace" data-href="{{ route('incidencias.show',$incidencia->id) }}">
                            <th scope="row">{{ $incidencia->created_at }}</th>
                            <td>{{ $incidencia->tecnico->nombre.' '.$incidencia->tecnico->apellidos }}</td>
                            <th>{{ $incidencia->ascensor->calle.' '.$incidencia->ascensor->bloque.' (Zona '.$incidencia->ascensor->zona->zona.')' }}</th>
                            
                            <td class="text-center">
                                @if($incidencia->urgente =="1")
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                @else
                                    -
                                @endif
                            </td>
                            
                            <td>
                                <div class="m-auto rounded-3 text-white
                                    @if( $incidencia->estado=='Pendiente' )
                                        bg-danger
                                    @elseif( $incidencia->estado=='En proceso' )
                                        bg-warning
                                    @else
                                        bg-success 
                                    @endif
                                        text-center">
                                    {{ $incidencia->estado }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
            </div>
            <div class="d-flex justify-content-center">
                {!! $incidencias->links() !!}
            </div>
        </div>
        
        <script>
            document.querySelectorAll('.tr-enlace').forEach(element => {
                element.addEventListener('click',() => {window.location=element.getAttribute('data-href');})
            });
        </script>
@endsection