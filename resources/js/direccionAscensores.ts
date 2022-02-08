var gAscensores,gTecnicos;

$("#bModal").click(function () {
    var calle:String = String($('#calle').val());
    var numero:String = String($('#numero').val());
    var numeroserie:String = String($('#numeroserie').val());
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
        var ulasc = $("#modalNumeroAscensor");
        var ultec = $("#modalNombreTecnico");
        ulasc.html("");
        ultec.html("");
        $('#datosTecnico').html('');
        
        if(arrayAscensores!='null'){
            let datos=JSON.parse(arrayAscensores);
            let ascensores = datos[0];
            let tecnicos = datos[1];
            let tecnicosNormales = [];
            let tecnicosUrgentes =[];
        
            tecnicos.forEach(tecnico => {
                if (tecnico.incidenciasUrgentes==0) {
                    tecnicosNormales.push(tecnico);
                } else {
                    tecnicosUrgentes.push(tecnico);
                }
            });
            tecnicosNormales.sort((a, b)=> {
                return a.incidenciasNormales < b.incidenciasNormales ? -1 : 1;
            });
            tecnicosUrgentes.sort((a, b)=> {
                return a.incidenciasUrgentes < b.incidenciasUrgentes ? -1 : 1;
            });
            tecnicosUrgentes.forEach(tecnico => {
                tecnicosNormales.push(tecnico);
            });
            tecnicos=tecnicosNormales;
            ascensores.forEach(m => ulasc.append('<li class="list-group-item border-0 p-0 my-1">' +
                ' <input type="radio" class="btn-check ascensorid" name="ascensores" id="a' + m.id + '" autocomplete="off" value="' + m.id + '">' +
                '<label class="btn btn-outline-primary m-0 w-100" for="a' + m.id + '">' + m.numeroserie + '</label></li>'));

            tecnicos.forEach(m => ultec.append('<li class="list-group-item border-0 p-0 my-1">' +
                ' <input type="radio" class="btn-check tecnicoid" name="tecnicos" id="t' + m.id + '" autocomplete="off" value="' + m.id + '">' +
                '<label class="btn btn-outline-dark d-flex justify-content-between m-0 w-100" for="t' + m.id + '">' + m.nombre + '<span class="badge bg-'+ m.background +' align-self-end rounded-pill">'+ (m.incidenciasNormales+m.incidenciasUrgentes) +'</span>' + '</label></li>'));
            gAscensores = ascensores;
            gTecnicos = tecnicos;
        }
        
    });
});


$('#bModalAceptar').click(function () {
    let ascensor=$('input:radio[name=ascensores]:checked').val();
    let tecnico=$('input:radio[name=tecnicos]:checked').val();
    console.log(tecnico);
    if(ascensor==null || tecnico==null) {
        
    } else {
        ascensor =gAscensores.find(a => a.id == ascensor);
        tecnico =gTecnicos.find(a => a.id == tecnico);console.log(tecnico);
        $('#numeroSerie').val(ascensor.numeroserie);
        $('#modeloAscensor').val(ascensor.modelo.modelo);
        $('#carga').val(ascensor.modelo.carga);
        $('#recorrido').val(ascensor.recorrido);
        $('#numParadas').val(ascensor.paradas);
        $('#incidencia').prepend('<div class="col-12" id="datosTecnico">'+
                                '<label class="form-label position-relative">'+
                                    '<input class="form-control" type="text" name="tecnico" id="tecnico" placeholder=" " disabled value="'+ tecnico.nombre + ' ' + tecnico.apellidos +'">'+
                                    '<span class="p-2">T&eacute;cnico</span>'+
                                '</label>'+
                            '</div>'
                    );
        $('#idAscensor').val(ascensor.id);
        $('#idTecnico').val(tecnico.id);
        $('#btnSubmit').attr("disabled",false);
    }
})