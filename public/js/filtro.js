$( document ).ready(function() {
    $('#bFiltar').click(filtrarIncidencias);

});


function filtrarIncidencias(){
    let nombreTecnico = $('#inputNombre').val();
    let zona = $('#selectZonas').val();
    let estado = $('#selectEstado').val();
    let fechaInicio = document.getElementById('fechas').shadowRoot.getElementById('fechaInicio').value+" 00:00:00";
    let fechaFin = document.getElementById('fechas').shadowRoot.getElementById('fechaFin').value+" 00:00:00";
    console.log(fechaInicio);
    let nombreRegex = /^([A-Z a-z]{3}[a-zñáéíóú]+[\s]*)+$/;
    let fechaRegex = /^([0-9]{4})-([0-1][0-9])-([0-3][0-9])\s([0-1][0-9]|[2][0-3]):([0-5][0-9]):([0-5][0-9])$/;

    let url = "/incidencias/filtrar?";
    let filtrado = false;
    if(fechaRegex.test(fechaInicio) && fechaRegex.test(fechaFin)){
        url+="fechainicio="+fechaInicio+"&fechafin="+fechaFin;
        filtrado=true;
    }
    if(nombreRegex.test(nombreTecnico)){
        if(filtrado==true){
            url+="&";
        }
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
        filtrado=true;
    }

    console.log(url);
    
    if(!filtrado){
        window.location.href="/incidencias";
    }
    else{
        window.location.href=url;
    }
    
}


function cargarValores(array){

}