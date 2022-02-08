$(document).ready(function(){ 
    rellenarSelectEstadisticas();
    gestionarSelectId();
    $('#cargarGrafica').click(crearGrafica)
    $('#tipoEstadistica').change(gestionarSelectId)
    crearGrafica("numIncidenciasPorZona");
  });
                                            //Como los datos depende de la grafica reciben un tratamiento diferente
  var rutasDatosEstadisticasColumnas ={     //los calsifico aqui depende en que array estan
    "numIncidenciasPorZona" : window.location.href+"/numIncidenciasPorZona",
    "numTipoIncidenciasPorZona" : window.location.href+"/numTipoIncidenciasPorZona",
    "numIncidenciasPorModelo" : window.location.href+"/numIncidenciasPorModelo",
    "tiempoMedioIncidenciaEquipo" : window.location.href+"/tiempoMedioIncidenciaEquipo",
    "tiempoMedioIncidenciaTecnico" : window.location.href+"/tiempoMedioIncidenciaTecnico",
    "tipoDeIncidenciasPorZona" : window.location.href+"/tipoDeIncidenciasPorZona",
  }
  var rutasDatosEstadisticasRosco ={
    "numIncidenciasPorModeloId" : window.location.href+"/numIncidenciasPorModeloId",
    "tipoDeIncidenciasPorZonaId" : window.location.href+"/tipoDeIncidenciasPorZonaId",
  }



  var nombreEstadisticas ={     //El nombre para meter en la select
    "numIncidenciasPorZona" : "Numero de incidencias por zona",
    "numTipoIncidenciasPorZona" : "Numero tipo de incidencias por zona",
    "numIncidenciasPorModelo" : "Numero tipo de incidencias por modelo",
    "tiempoMedioIncidenciaEquipo" : "Tiempo medio incidencias equipo",
    "tiempoMedioIncidenciaTecnico" : "Tiempo medio incidencias tecnicos por equipo",
    "tipoDeIncidenciasPorZona" : "Tipo de incidencias por zona",
    "numIncidenciasPorModeloId" : "Numero de tipo de incidencias por modelo id",
    "tipoDeIncidenciasPorZonaId" : "Numero de tipo de incidencias por zona id",
  }

//--------------Gestion select por id----------
function gestionarSelectId(){
  if(rutasDatosEstadisticasRosco[$('#tipoEstadistica').val()]==undefined && $('#tipoEstadistica').val()!='tiempoMedioIncidenciaTecnico'){
    $('#id').addClass('invisible');
  }
  else{
    $('#id').removeClass('invisible');
    let datos;
    if($('#tipoEstadistica').val()=="numIncidenciasPorModeloId"){
      datos=llamadaAjaxIds('modelos');
    }
    else if($('#tipoEstadistica').val()=="tipoDeIncidenciasPorZonaId"){
      datos=llamadaAjaxIds('zonas');
    }
    else if($('#tipoEstadistica').val()=="tiempoMedioIncidenciaTecnico"){
      datos=llamadaAjaxIds('equipos');
    }
  }
}

//-----------Llamada webservice ids-------  problema con
function llamadaAjaxIds(tipo){
  let url = new Array();
  url['modelos']= window.location.href+'/getModelos';
  url['equipos']= window.location.href+'/getEquipos';
  url['zonas']= window.location.href+'/getZonas';
  $.ajax({
    type: "GET", 
    url:  url[tipo], // AQUI apuntamos al PHP
    dataType:'json',
    success: function(datos){
      console.log(datos);
      rellenarSelectIds(datos);
    },
    error: function(e){
        console.log("Algo salio mal");
    }       
  });
}
//-----------Rellenar select ids---------
function rellenarSelectIds(datos){
  let opciones="";
  for (const [key, value] of Object.entries(datos)) {
    let opcion="<option value='"+key+"'>"+value+"</option>";
    opciones+=opcion;
  };
  $('#id').html(opciones);
}


//-----------Rellenar select tipos estadisticas--------
function rellenarSelectEstadisticas(){
  let opciones="";
  for (const [key, value] of Object.entries(nombreEstadisticas)) {
    let opcion="<option value='"+key+"'>"+value+"</option>";
    opciones+=opcion;
  };
  
  $('#tipoEstadistica').html(opciones);
}



  //---------Estadisticas -------------
  function crearGrafica(){
    let fechaInicio=$('#fechaInicio').val();
    let fechaFin=$('#fechaFin').val();
    let tipoEstadistica=$('#tipoEstadistica').val()
    let id=$('#id').val()
    let tipoGrafico="";
    url="";
    

    if(rutasDatosEstadisticasColumnas[tipoEstadistica]!=undefined){
      tipoGrafico="columnas";
      if(id!=undefined){
        if(fechaInicio != ""){
          url=rutasDatosEstadisticasColumnas[tipoEstadistica]+"?fechaInicio="+fechaInicio+"&fechaFin="+fechaFin+"&id="+id;
        }
        else{
          url=rutasDatosEstadisticasColumnas[tipoEstadistica]+"?id="+id;
        }
      }
      else{
        if(fechaInicio != ""){
          url=rutasDatosEstadisticasColumnas[tipoEstadistica]+"?fechaInicio="+fechaInicio+"&fechaFin="+fechaFin+"&id=all";
        }
        else{
          url=rutasDatosEstadisticasColumnas[tipoEstadistica]+"?id=all";
        }
      }
    }
    else if(rutasDatosEstadisticasRosco[tipoEstadistica]!=undefined){
      tipoGrafico="rosco";
      if(id!=undefined){
        if(fechaInicio != ""){
          url=rutasDatosEstadisticasRosco[tipoEstadistica]+"?fechaInicio="+fechaInicio+"&fechaFin="+fechaFin+"&id="+id;
        }
        else{
          url=rutasDatosEstadisticasRosco[tipoEstadistica]+"?id="+id;
        }
      }
      else{
        if(fechaInicio != ""){
          url=rutasDatosEstadisticasRosco[tipoEstadistica]+"?fechaInicio="+fechaInicio+"&fechaFin="+fechaFin+"&id=all";
        }
        else{
          url=rutasDatosEstadisticasRosco[tipoEstadistica]+"?id=all";
        }
      }
    }
    
    
    $.ajax({
      type: "GET", 
      url:  url, // AQUI apuntamos al PHP
      dataType:'json',
      success: function(datos){
          if(tipoGrafico=="rosco"){
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(function(){ drawChartRosco(tipoEstadistica,datos) });
          }
          else if(tipoGrafico=="columnas"){
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(function(){ drawChartColumna(tipoEstadistica,datos) });
          }
      },
      error: function(){
          console.log("Algo salio mal");
      }       
    });
  }
  

  //-------------Grafica rosco-----------
  function drawChartRosco(estadistica, datos) {
    var data = new Array();
    switch(estadistica){
      case "tipoDeIncidenciasPorZonaId":
        data.push(datos['nombrecolumnas']);
        for (const [key, value] of Object.entries(datos['datos'])) {
          data.push([key,value]);
        }
        break;
      case "numIncidenciasPorModeloId":
        data.push(datos['nombrecolumnas']);
        for (const [key, value] of Object.entries(datos['datos'])) {
          data.push([key,value]);
        }
        break;
    }
    console.log(data);
    
    data = google.visualization.arrayToDataTable(data);
  
    var options = {
      chart: {
        title: datos['titulo'],
        is3D: true,
      }
    };
  
    var chart = new google.visualization.PieChart(document.getElementById('contenedor_estadistica'));
    chart.draw(data, options);
  }





  //--------Grafica columnas-----

function drawChartColumna(estadistica, datos) {
  var data = new Array();
  switch(estadistica){
    case "tipoDeIncidenciasPorZona":
      data.push(datos['nombrecolumnas']);
      for (const [key, value] of Object.entries(datos['datos'])) {
        data.push([key,value['electrica'], value['mecanica'], value['estetica']]);
      }
      break;
    case "numTipoIncidenciasPorZona":
      data.push(datos['nombrecolumnas']);
      for (const [key, value] of Object.entries(datos['datos'])) {
        data.push([key,value['Todas'], value['Electrica'], value['Mecanica'], value['Estetica']]);
      }
      console.log(data);
      break;
      case "tiempoMedioIncidenciaEquipo":
        data.push(datos['nombrecolumnas']);
        for (const [key, value] of Object.entries(datos['datos'])) {
          data.push([key,value]);
        }
        break;
    case "tiempoMedioIncidenciaTecnico":
      data.push(datos['nombrecolumnas']);
      for (const [key, value] of Object.entries(datos['datos'])) {
        data.push([key,value]);
      }
      break;
    case "numIncidenciasPorModeloId":
      data.push(datos['nombrecolumnas']);
      for (const [key, value] of Object.entries(datos['datos'])) {
        data.push([key,value['Todas'], value['Electrica'], value['Mecanica'], value['Estetica']]);
      }
      break;
    case "numIncidenciasPorModelo":
      data.push(datos['nombrecolumnas']);
      for (const [key, value] of Object.entries(datos['datos'])) {
        data.push([key,value['Todas'], value['Electrica'], value['Mecanica'], value['Estetica']]);
      }
      console.log(data);
      break;
    case "numIncidenciasPorZona":
      data.push(datos['nombrecolumnas']);
      for (const [key, value] of Object.entries(datos['datos'])) {
        data.push([key,value]);
      }
      console.log(data);
      break;
    
      
  }

  data = google.visualization.arrayToDataTable(data);

  var options = {
    chart: {
      title: datos['titulo'],
    }
  };

  var chart = new google.charts.Bar(document.getElementById('contenedor_estadistica')); //hacer referncia al contenedor
  chart.draw(data, google.charts.Bar.convertOptions(options));
}
