/**
 * IMPORTANTE
 * Esto hay que mergearlo en main.js MANUALMENTE
 * Hecho aparte para evitar conflictos si alguien estuvo modificando main.js
 */

$(document).ready(function(){

$('#postMessageBtn').click(postMessage);


});


function postMessage(){
    //Traigo todo el contenido del mensaje
    var content = $("#message").val();

    //Obtengo el nombre de usuario al que se le destina el mensaje (el back lo consulta y obtiene de qué muro se trata)
    var pathname = window.location.pathname;
    var pathname_array = pathname.split("/");
    var toUser = pathname_array[pathname_array.length - 1];
    //Habria que hacer algo más acá para que le saque el ".php" al user.


    //Envio los datos al back para que el controller los procese
    //El id_usuario que envia el mensaje y el rol lo obtengo en el back desde las sessions.
    $.post( "php/controllers/postMessageCtrl.php", { content : content, toUser : toUser }, doSomething );
}

function doSomething(data){
    console.log(data);
}
