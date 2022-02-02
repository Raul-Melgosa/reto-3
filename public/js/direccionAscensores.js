$("#bModal").click(function () {
    var calle = String($('#calle').val());
    var numero = String($('#numero').val());
    var direccion = {
        "calle": "calle=" + calle,
        "numero": "&numero=" + numero
    };
    $.ajax({
        url: "http://reto3.test/incidencias/create/direccion?" + direccion['calle'],
        type: 'get'
    })
        .done(function (ascensor) {
        $("#modalNumeroAscensor").append('<li class="list-group-item border-0 p-0 my-1">' +
            ' <input type="radio" class="btn-check" name="ascensores" id="ascensor' + ascensor.id + '" autocomplete="off" value="' + ascensor.id + '">' +
            '<label class="btn btn-outline-primary m-0 w-100" for="primero">' + ascensor.numeroserie + '</label></li>');
    });
});
