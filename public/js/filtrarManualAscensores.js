$("#filtrar").click(function () {
    ascensor=$("#buscarAscensor").val();
    if(ascensor!=""){
        $.ajax({
            url: window.location.href+"/buscar?" +'ascensor='+ascensor ,
            type: 'get'
        }).done(function (arrayAscensores) {
            ascensores=JSON.parse(arrayAscensores);
            
        })
    }
})