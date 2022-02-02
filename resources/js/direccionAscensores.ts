
    $("#bModal").click(function() {
        let calle:string=String($('#calle').val());
        let numero:string=String($('#numero').val());
        let direccion={
            "calle":"calle="+calle,
            "numero":"&numero="+numero
        };
        $.ajax({
            url:   "http://reto3.test/incidencias/create/direccion?"+direccion['calle'],
            type:  'get', //método de envio
        })
        .done(function( ascensor) {
            let ul=$("#modalNumeroAscensor")
            let ascensores=JSON.parse(ascensor) ;
            if(ascensores.length>0){
                ascensores.forEach(m => ul.append('<li class="list-group-item border-0 p-0 my-1">'+
            ' <input type="radio" class="btn-check" name="ascensor" id="ascensor'+m.id+'" autocomplete="off" value="'+m.id+'">'+
                '<label class="btn btn-outline-primary m-0 w-100" for="primero">'+m.numeroserie+'</label></li>'));
            }else{
                ul.append('<li class="list-group-item border-0 p-0 my-1">'+
            ' <input type="radio" class="btn-check" name="ascensor" id="ascensor'+ascensores.id+'" autocomplete="off" value="'+ascensores.id+'">'+
                '<label class="btn btn-outline-primary m-0 w-100" for="primero">'+ascensores.numeroserie+'</label></li>')
            }
        })
    })