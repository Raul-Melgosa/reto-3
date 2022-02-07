$(document).ready(function(){ 
    crearGraficaRosco("tipoDeIncidenciasPorZonaId");
  });
  
  var rutasDatosEstadisticas ={
    "numIncidenciasPorZona" : "http://igobideapp.test/estadisticas/numIncidenciasPorZona",
    "numTipoIncidenciasPorZona" : "http://igobideapp.test/estadisticas/numTipoIncidenciasPorZona",
    "numIncidenciasPorModelo" : "http://igobideapp.test/estadisticas/numIncidenciasPorModelo",
    "numIncidenciasPorModeloId" : "http://igobideapp.test/estadisticas/numIncidenciasPorModeloId",
    "tiempoMedioIncidenciaEquipo" : "http://igobideapp.test/estadisticas/tiempoMedioIncidenciaEquipo",
    "tiempoMedioIncidenciaTecnico" : "http://igobideapp.test/estadisticas/tiempoMedioIncidenciaTecnico",
    "tipoDeIncidenciasPorZona" : "http://igobideapp.test/estadisticas/tipoDeIncidenciasPorZona",
    "tipoDeIncidenciasPorZonaId" : "http://igobideapp.test/estadisticas/tipoDeIncidenciasPorZonaId",
  }


  function crearGraficaRosco(tipoEstadistica){
    url=rutasDatosEstadisticas[tipoEstadistica];
    $.ajax({
      type: "GET", 
      url:  url, // AQUI apuntamos al PHP
      dataType:'json',
      success: function(datos){
          console.log(datos);
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(function(){ drawChartRosco(tipoEstadistica,datos) });
      },
      error: function(){
          console.log("Algo salio mal");
      }       
    });
  }
  
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