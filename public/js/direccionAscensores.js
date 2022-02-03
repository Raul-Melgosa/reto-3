$("#bModal").click(function () {
    var calle = String($('#calle').val());
    var numero = String($('#numero').val());
    var numeroserie = String($('#numeroserie').val());
    if(calle==""){
        calle=""
    }
    if(numero==""){
        numero=""
    }
    if(numeroserie==""){
        numeroserie=""
    }

    var direccion = {
        "calle": "calle=" + calle,
        "numero": "&numero=" + numero,
        "numeroserie":"&numeroserie="+numeroserie
    };
    $.ajax({
        url: "http://reto3.test/incidencias/create/direccion?" + direccion['calle']+direccion['numero']+direccion['numeroserie'],
        type: 'get'
    })
    .done(function (arrayAscensores) {
        var ul = $("#modalNumeroAscensor");
        ul.html("");
        ascensores=JSON.parse(arrayAscensores)
        
        if (ascensores.length > 0) {
            ascensores.forEach(m => ul.append('<li class="list-group-item border-0 p-0 my-1">' +
                ' <input type="radio" class="btn-check ascensorid" name="ascensores" id="' + m.id + '" autocomplete="off" value="' + m.id + '">' +
                '<label class="btn btn-outline-primary m-0 w-100" for="' + m.id + '">' + m.numeroserie + '</label></li>'))
        }
        else {
            ul.append('<li class="list-group-item border-0 p-0 my-1">' +
            ' <input type="radio" class="btn-check ascensorid" name="ascensores" id="'+ m.id + '" autocomplete="off" value="' + m.id + '">' +
            '<label class="btn btn-outline-primary m-0 w-100" for="' + m.id + '">' + ascensores.numeroserie + '</label></li>');
        }
    });
});
61