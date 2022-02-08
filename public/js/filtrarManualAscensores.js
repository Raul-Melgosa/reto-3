$("#filtrar").click(function () {
    ascensor=$("#buscarAscensor").val();
    var dato = {
        "ascensor": "ascensor=" + ascensor,
    }
    
    $.ajax({
        url: window.location.href+"/buscar?"+dato['ascensor'],
        type: 'get'
    })
    .done(function (arrayAscensores) {
        ascensores=JSON.parse(arrayAscensores);
        div=$('#acordeonManuales');
        div.html("");
        console.log(ascensores)
        if(ascensores!='null'){
            ascensores.forEach(a => div.append(
                '<div class="accordion-item">'+
                    '<h2 class="accordion-header" id="heading'+a.id+'">'+
                        
                        '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'+a.modelo.id+'" aria-expanded="true" aria-controls="collapse'+a.modelo.id+'">'+
                            +a.modelo+
                        '</button>'+
                    '</h2>'+
                    '<div id="collapse'+a.modelo.id+'" class="accordion-collapse collapse  "  data-bs-parent="#acordeonManuales">'+
                        '<div class="accordion-body">'+
                            '<iframe src="{{ asset("storage/manuales/) }}"'+'/'+a.modelo.manual+'" width="100%" height="400vh"></iframe>'+
                        '</div>'+
                    '</div>'+
                '</div>'));
        }
        
        
    });
});