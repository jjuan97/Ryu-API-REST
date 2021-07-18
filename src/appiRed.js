var horaInicio = document.getElementById("horaInicio");
var horaFinalizacion = document.getElementById("horaFinalizacion");
var hostOrigen = document.getElementById("hostOrigen");
var hostDestino = document.getElementById("hostDestino");

var Agregar = document.getElementById("Agregar");

window.addEventListener('load', limpiar, false);

function limpiar() {

    horaFinalizacion.value = "";
    horaInicio.value = "";
    hostDestino.value = "";
    hostOrigen.value = "";

}

Agregar.onsubmit = function (e) {


    var estado = 1;
    var verfHI = 1;
    var verfHF = 1;
    var verfHO = 1;
    var verfHD = 1;

    if (Agregar.Estado[0].checked == false && Agregar.Estado[1].checked == false) {
        alert(" Debe escoger un estado Permanente o Temporal")
        estado = 1;
    } else {
        estado = 0;
        if (Agregar.Estado[0].checked == true) {
            horaInicio.value = "00:00";
            horaFinalizacion.value = "00:00";
        }
    }

    if (horaInicio.value != "") {

        horaInicio.classList.remove("Necesarias");
        verfHI = 0;

    }
    else {
        horaInicio.classList.add("Necesarias");
        verfHI = 1;
    }
    if (horaFinalizacion.value != "") {
        horaFinalizacion.classList.remove("Necesarias");
        verfHF = 0;
    }
    else {
        horaFinalizacion.classList.add("Necesarias");
        verfHF = 1;
    }
    if (hostDestino.value != "") {
        hostDestino.classList.remove("Necesarias");
        verfHD = 0;
    }
    else {
        hostDestino.classList.add("Necesarias");
        verfHD = 1;
    }
    if (hostOrigen.value != "") {
        hostOrigen.classList.remove("Necesarias");
        verfHO = 0;
    }
    else {
        hostOrigen.classList.add("Necesarias");
        verfHO = 1;
    }


    if (verfHI != 1 && verfHF != 1 && verfHD != 1 && verfHO != 1 && estado != 1) {

        var comprovacionHoraInicio = [];
        var comprovacionHoraFin = [];
        var errorHoraIni = 0;
        var errorHoraFin = 0;
        

        hostOrigen.value = String(hostOrigen.value);
        hostDestino.value = String(hostDestino.value);

        if (horaInicio.value.length == 5) {
            
            for (var i = 0; i < horaInicio.value.length; i++) {
                comprovacionHoraInicio.push(horaInicio.value.charAt(i));
            }
            var horasIni = ""+comprovacionHoraInicio[0]+""+comprovacionHoraInicio[1]+"";
            var minIni = ""+comprovacionHoraInicio[3]+""+comprovacionHoraInicio[4]+"";
            
            if(comprovacionHoraInicio[2]!=":" || parseInt(horasIni) > 24  || parseInt(minIni) > 60 ){
                
            horaInicio.value="";
            errorHoraIni = 1;

            }else{
                errorHoraIni = 0;
            }
        }else{
            
            horaInicio.value="";
            errorHoraIni=1;
        }

        if (horaFinalizacion.value.length == 5) {
            a
            for (var i = 0; i < horaFinalizacion.value.length; i++) {
                comprovacionHoraFin.push(horaFinalizacion.value.charAt(i));
            }

            var horasfin = ""+comprovacionHoraFin[0]+""+comprovacionHoraFin[1]+"";
            var minfin = ""+comprovacionHoraFin[3]+""+comprovacionHoraFin[4]+"";
            if(comprovacionHoraFin[2]!=":" || parseInt(horasfin) > 24 || parseInt(minfin) > 60 ){
              
            horaFinalizacion.value="";
            errorHoraFin = 1;
            }else{
                errorHoraFin =0;
            }
        }else{
           
            horaFinalizacion.value="";
            errorHoraFin = 1;
        }


        if(errorHoraIni == 1 || errorHoraFin ==1){
            alert("Hora/s mal escrita/s")
            return false;
        }


        horaFinalizacion.value = String(horaFinalizacion.value) + ":00:00";
        horaInicio.value = String(horaInicio.value) + ":00:00";

        alert("Nueva regla agregada");

    } else {
        e.preventDefault();
    }

}


