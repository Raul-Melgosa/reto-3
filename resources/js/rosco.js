$(document).ready(function(){ 
    console.log("hola");
    alert("hola");
    $.ajax({
        type: "GET", 
        url:  "http://igobideapp.test/datos", // AQUI apuntamos al PHP
        dataType:'json',
        success: function(datos){
            console.log(datos);
            console.log("Algo salio bien");
            google.charts.setOnLoadCallback(function(){ drawChart(datos['datos']) });
        },
        error: function(){
            console.log("Algo salio mal");
        }      
    });
});

function drawChart(datos) {
    var data = google.visualization.arrayToDataTable([
        function(){
            data=new Array();
            data.push([datos['tipo'], datos['numero']]); //El titulo de la columnas
            datos['datos'].forEach(key,value => {
                data.push([key,value]);
            });

        }
      ]);

      var options = {
        title: datos['titulo']
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
