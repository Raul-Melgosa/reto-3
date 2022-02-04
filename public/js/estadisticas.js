$(document).ready(function(){ 
    rellenarSelectEstadisticas();
    gestionarSelectId();
    $('#cargarGrafica').click(crearGrafica)
    $('#tipoEstadistica').change(gestionarSelectId)
    crearGrafica("numIncidenciasPorZona");
  });
                                            //Como los datos depende de la grafica reciben un tratamiento diferente
  var rutasDatosEstadisticasColumnas ={     //los calsifico aqui depende en que array estan
    "numIncidenciasPorZona" : "http://igobideapp.test/estadisticas/numIncidenciasPorZona",
    "numTipoIncidenciasPorZona" : "http://igobideapp.test/estadisticas/numTipoIncidenciasPorZona",
    "numIncidenciasPorModelo" : "http://igobideapp.test/estadisticas/numIncidenciasPorModelo",
    "tiempoMedioIncidenciaEquipo" : "http://igobideapp.test/estadisticas/tiempoMedioIncidenciaEquipo",
    "tiempoMedioIncidenciaTecnico" : "http://igobideapp.test/estadisticas/tiempoMedioIncidenciaTecnico",
    "tipoDeIncidenciasPorZona" : "http://igobideapp.test/estadisticas/tipoDeIncidenciasPorZona",
  }
  var rutasDatosEstadisticasRosco ={
    "numIncidenciasPorModeloId" : "http://igobideapp.test/estadisticas/numIncidenciasPorModeloId",
    "tipoDeIncidenciasPorZonaId" : "http://igobideapp.test/estadisticas/tipoDeIncidenciasPorZonaId",
  }

//--------------Gestion select por id----------
function gestionarSelectId(){
  if(rutasDatosEstadisticasRosco[$('#tipoEstadistica').val()]==undefined){
    $('#id').addClass('d-none');
  }
  else{
    $('#id').removeClass('d-none');
    let datos;
    if(rutasDatosEstadisticasRosco[$('#tipoEstadistica').val()]=="numIncidenciasPorModeloId"){
      datos=llamadaAjaxIds('modelos');
    }
    else if(rutasDatosEstadisticasRosco[$('#tipoEstadistica').val()]=="tipoDeIncidenciasPorZonaId"){
      datos=llamadaAjaxIds('zonas');
    }
  }
}

//-----------Llamada webservice ids-------
function llamadaAjaxIds(tipo){
  url['modelos']='http://igobideapp.test/estadisticas/getModelos';
  url['tecnicos']='http://igobideapp.test/estadisticas/getTecnicos';
  url['zonas']='http://igobideapp.test/estadisticas/getZonas';
  $.ajax({
    type: "GET", 
    url:  url[tipo], // AQUI apuntamos al PHP
    dataType:'json',
    success: function(datos){
      console.log(datos);
      rellenarSelectIds(datos);
    },
    error: function(){
        console.log("Algo salio mal");
    }       
  });
}
//-----------Rellenar select ids---------
function rellenarSelectIds(datos){
  let opciones="";
  for (const [key, value] of Object.entries(datos)) {
    let opcion="<option value='"+key+"'>"+key+"</option>";
    opciones+=opcion;
  };
  for (const [key, value] of Object.entries(datos)) {
    let opcion="<option value='"+key+"'>"+key+"</option>";
    opciones+=opcion;
  };
  $('#id').html(opciones);
}


//-----------Rellenar select tipos estadisticas--------
function rellenarSelectEstadisticas(){
  let opciones="";
  for (const [key, value] of Object.entries(rutasDatosEstadisticasColumnas)) {
    let opcion="<option value='"+key+"'>"+key+"</option>";
    opciones+=opcion;
  };
  for (const [key, value] of Object.entries(rutasDatosEstadisticasRosco)) {
    let opcion="<option value='"+key+"'>"+key+"</option>";
    opciones+=opcion;
  };
  $('#tipoEstadistica').html(opciones);
}



  //---------Estadisticas rosco-------------
  function crearGrafica(){
    let fechaInicio=$('#fechaInicio').val();
    let fechaFin=$('#fechaFin').val();
    let tipoEstadistica=$('#tipoEstadistica').val()
    let tipoGrafico="";
    url="";
    
    if(rutasDatosEstadisticasColumnas[tipoEstadistica]!=undefined){
      tipoGrafico="columnas";
      if(fechaInicio != ""){
        url=rutasDatosEstadisticasColumnas[tipoEstadistica]+"?fechaInicio="+fechaInicio+"&fechaFin="+fechaFin;
      }
      else{
        url=rutasDatosEstadisticasColumnas[tipoEstadistica];
      }
    }
    else if(rutasDatosEstadisticasRosco[tipoEstadistica]!=undefined){
      tipoGrafico="rosco";
      if(fechaInicio != ""){
        url=rutasDatosEstadisticasRosco[tipoEstadistica]+"?fechaInicio="+fechaInicio+"&fechaFin="+fechaFin;
      }
      else{
        url=rutasDatosEstadisticasRosco[tipoEstadistica];
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