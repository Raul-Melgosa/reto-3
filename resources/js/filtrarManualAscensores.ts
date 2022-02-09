$("#filtrar").click(function () {
    let ascensor=$("#buscarAscensor").val();
    
    $.ajax({
        url: window.location.href+"/buscar?ascensor="+ ascensor,
        type: 'get'
    })
    .done(function (arrayAscensores) {
        let ascensores=JSON.parse(arrayAscensores);
        let div=$('#acordeonManuales');
        div.html("");
        if(ascensores!='null'){
            ascensores.array.forEach(a => div.append(
                '<div class="accordion-item">'+
                    '<h2 class="accordion-header" id="heading'+a.modelo.id+'">'+
                        
                        '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'+a.modelo.id+'" aria-expanded="true" aria-controls="collapse'+a.modelo.id+'">'+
                            +a.modelo.modelo+
                        '</button>'+
                    '</h2>'+
                    '<div id="collapse'+a.modelo.id+'" class="accordion-collapse collapse  "  data-bs-parent="#acordeonManuales">'+
                        '<div class="accordion-body">'+
                            '<iframe src="{{ asset("+'+"storage/manuales/"+'+") }}'+'/'+a.modelo.modelo+'" width="100%" height="400vh"></iframe>'+
                        '</div>'+
                    '</div>'+
                '</div>'));
        }
        
        
    });
});