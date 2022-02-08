$( document ).ready(function() {
    $('#bFiltar').click(filtarIncidencias);

});


function filtrarIncidencias(){
    let nombreTecnico = $('#inputNombre').val();
    let zona = $('#selectZonas').val();
    let estado = $('#selectEstado').val();
    let url = window.location.href+"/filtrar?";

    let nombreRegex = /^([a-zñáéíóú]+[\s]*)+$/;

    let filtrado = false;
    if(nombreRegex.test(nombreTecnico)){
        url+="nombre="+nombreTecnico;
        filtrado=true;
    }
    if(zona!="undefined"){
        if(filtrado==true){
            url+="&";
        }
        url+="zona="+zona;
        filtrado=true;
    }
    if(estado!="undefined"){
        if(filtrado==true){
            url+="&";
        }
        url+="estado="+estado;
    }
    console.log(url);
    

    window.location.replace(url);
}