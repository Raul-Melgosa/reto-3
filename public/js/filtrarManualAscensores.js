$("#filtrar").click(function () {
    ascensor=$("#buscarAscensor").val();
    var dato = {
        "ascensor": "ascensor=" + ascensor,
    }
    
    $.ajax({
        url: window.location.href+"/buscar?"+dato['ascensor'],
        type: 'get'
    })
    .done(function (manual) {
        ascensores=JSON.parse(manual);
        div=$('#acordeonManuales');
        ruta=$('#ruta').val();
        div.html("");
        console.log(ascensores)
        if(ascensores!='null'){
            ascensores.forEach(a => console.log(a.modelo));
            ascensores.forEach(a => div.append(
                '<div class="accordion-item">'+
                    '<h2 class="accordion-header" id="heading'+a.id+'">'+
                        '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'+a.id+'" aria-expanded="true" aria-controls="collapse'+a.id+'">'+
                            a.modelo+
                        '</button>'+
                    '</h2>'+
                    '<div id="collapse'+a.id+'" class="accordion-collapse collapse  "  data-bs-parent="#acordeonManuales">'+
                        '<div class="accordion-body">'+
                            '<iframe src="'+ruta+'/'+a.manual+'" width="100%" height="400vh"></iframe>'+
                        '</div>'+
                    '</div>'+
                '</div>'));
        }
        
        
    });
});