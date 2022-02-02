$(document).ready(function(){ 
    $.ajax({
        type: "GET", 
        url:  "http://igobideapp.test/datos", // AQUI apuntamos al PHP
        dataType:'json',
        success: function(datos){
            console.log(datos);
            
            google.charts.setOnLoadCallback(function(){ drawChart(datos) });
        },
        error: function(){
            console.log("Algo salio mal");
        }      
    });
});

function drawChart(datos) {
    console.log(datos);
    data=new Array();
    data.push([datos['tipo'], datos['numero']]); //El titulo de la columnas
    console.log(data);
    for (const [key, value] of Object.entries(datos['datos'])) {
        data.push([key,value]);
    }
    console.log(data);
    var data = google.visualization.arrayToDataTable(data);

    var options = {
        title: datos['titulo']
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

    chart.draw(data, options);
    }
