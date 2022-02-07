$(document).ready(function(){ 
  //crearGraficaColumna("numTipoIncidenciasPorZona");
});





function crearGraficaColumna(tipoEstadistica){
  url=rutasDatosEstadisticas[tipoEstadistica];
  $.ajax({
    type: "GET", 
    url:  url, // AQUI apuntamos al PHP
    dataType:'json',
    success: function(datos){
        console.log(datos);
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(function(){ drawChartColumna(tipoEstadistica,datos) });
    },
    error: function(){
        console.log("Algo salio mal");
    }       
  });
}

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