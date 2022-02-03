$(document).ready(function(){ 
  crearGraficaColumna("numTipoIncidenciasPorZona");
});





function crearGraficaColumna(tipoEstadistica : string) : void{
  let url=rutasDatosEstadisticas[tipoEstadistica];
  $.ajax({
    type: "GET", 
    url:  url, // AQUI apuntamos al PHP
    dataType:'json',
    success: function(datos){
        console.log(datos);
        //@ts-ignore
        google.charts.load('current', {'packages':['bar']});
        //@ts-ignore
        google.charts.setOnLoadCallback(function(){ drawChartColumna(tipoEstadistica,datos) });
    },
    error: function(){
        console.log("Algo salio mal");
    }       
  });
}

function drawChartColumna(estadistica : string, datos : Array<any>) : void{
  var data = new Array();
  switch(estadistica){
    case "tipoDeIncidenciasPorZona":
      data.push(datos['nombrecolumnas']);
      for (const [key, value] of Object.entries(datos['datos'])) {
        //@ts-ignore
        data.push([key,value['electrica'], value['mecanica'], value['estetica']]);
      }
      break;
    case "numTipoIncidenciasPorZona":
      data.push(datos['nombrecolumnas']);
      for (const [key, value] of Object.entries(datos['datos'])) {
        //@ts-ignore
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
        //@ts-ignore
        data.push([key,value['Todas'], value['Electrica'], value['Mecanica'], value['Estetica']]);
      }
      break;
    case "numIncidenciasPorModelo":
      data.push(datos['nombrecolumnas']);
      for (const [key, value] of Object.entries(datos['datos'])) {
        //@ts-ignore
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
  
  //@ts-ignore
  data = google.visualization.arrayToDataTable(data);


  var options = {
    chart: {
      title: datos['titulo'],
    }
  };
//@ts-ignore
  var chart = new google.charts.Bar(document.getElementById('contenedor_estadistica')); //hacer referncia al contenedor
//@ts-ignore
  chart.draw(data, google.charts.Bar.convertOptions(options));
}