<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
  </head>
  <body>
    <div class="form-group">
        <div class='input-group date' id='datetimepickerInicio'>
          <input type='text' class="form-control"  id="fechaInicio" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
        <br>
        <div class='input-group date' id='datetimepickerFin'>
          <input type='text' class="form-control" id="fechaFin" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
        <br>
        <button type="button" id="cargarGrafica">Cargar</button>
        <select id="tipoEstadistica">
          
        </select>
        <select id="id">
          
        </select>
    </div>

    <div id="contenedor_estadistica" style="width: 900px; height: 500px;"></div>
    <script type="text/javascript" src=" {{ asset('js/estadisticas.js') }} "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {
          let opciones = {
                            format: 'YYYY-MM-DD 00:00:00',
                          }
           $('#datetimepickerInicio').datetimepicker(opciones);
           $('#datetimepickerFin').datetimepicker(opciones);
        });
    </script>   
    </body>
</html>