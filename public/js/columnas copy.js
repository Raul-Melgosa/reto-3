$(document).ready(function(){ 
  $.ajax({
      type: "GET", 
      url:  "http://igobideapp.test/datos", // AQUI apuntamos al PHP
      dataType:'json',
      success: function(datos){
          google.charts.setOnLoadCallback(function(){ drawChart(datos) });
      },
      error: function(){
          console.log("Algo salio mal");
      }      
  });
});


function tiempoMedioIncidenciaTecnico(datos){
      function drawChart(datos) {
        var data = new Array();
        console.log(datos['nombrecolumnas']);
        data.push(datos['nombrecolumnas']);
        for (const [key, value] of Object.entries(datos['datos'])) {
          data.push([key, value['electrica'], value['mecanica'], value['estetica']]);
        }
        console.log(data);
        data = google.visualization.arrayToDataTable(data);
    
    
        var options = {
          chart: {
            title: datos['titulo'],
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
}