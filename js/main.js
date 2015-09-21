$(document).ready(function(){

	$('#sendMessageBtn').click(sendPrivateMessage);
	$('#postMessageBtn').click(postMessage);
	$('#privateMessageModalBtn').click(openPrivateMessageModal);
	$('#inboxModalBtn').click(openInboxModal);
	$('.conversation-item').click(openPrivateMessageModalFromInbox);
	$("#sendMessageFromInboxBtn").click(sendPrivateMessageFromInbox);

	$('#modalPrivateMessages').on('shown.bs.modal', function () {
		$("#message-area-private").scrollTop($("#message-area-private")[0].scrollHeight);

	});
	$('#modalPrivateMessagesInbox').on('shown.bs.modal', function () {
		$("#message-area-inbox").scrollTop($("#message-area-inbox")[0].scrollHeight);

	});
});

function mostrar_ocultar(cual) {
   var elElemento=document.getElementById(cual);
   if(elElemento.style.display == 'block') {
      elElemento.style.display = 'none';
   } else {
      elElemento.style.display = 'block';
   }
}

//BLOQUEA EL TECLADO PERMITIENDOME INGRESAR SOLO LETRAS
function sololetras(e) {
	key=e.keyCode || e.which;//capturo la entrada del teclado
	
	teclado=String.fromCharCode(key).toLowerCase();/*guardo en la variable 'teclado' la entrada del teclado
													y todo texto recibido ya sea mayuscula o minuscula lo convierte en minuscula*/
	letras="qwertyuiopasdfghjklñzxcvbnm áéíóú";
	
	especiales="8-37-38-46-164";//espacio - flecha para la izquierda - flecha para la derecha - suprimir - eñe
	
	teclado_especial=false;
		
	for(var i in especiales){//busco tecla presionada en array especiales
		if(key==especiales[i]){
			teclado_especial=true;
			break;
		}
	}
	
	if(letras.indexOf(teclado)==-1 && !teclado_especial){//verifico que el caracter esta dentro de la cadena (letras y especiales)
		return false;
	}	
}

//BLOQUEA EL TECLADO PERMITIENDOME INGRESAR SOLO NUMEROS
function solonumeros(e) {
	key=e.keyCode || e.which;//capturo la entrada del teclado
	
	teclado=String.fromCharCode(key);//guardo en la variable 'teclado' la entrada del teclado
	
	numeros="0123456789";
	
	especiales="8-37-38-46";//espacio - flecha para la izquierda - flecha para la derecha - suprimir
	
	teclado_especial=false;
		
	for(var i in especiales){//busco tecla presionada en array especiales
		if(key==especiales[i]){
			teclado_especial=true;
			break;
		}
	}
	
	if(numeros.indexOf(teclado)==-1 && !teclado_especial){//verifico que el caracter esta dentro de la cadena (numeros y especiales)
		return false;
	}	
}

//BLOQUEA EL TECLADO PERMITIENDOME INGRESAR SOLO LETRAS y NUMEROS
function lyn(e) {
	key=e.keyCode || e.which;//capturo la entrada del teclado
	
	teclado=String.fromCharCode(key).toLowerCase();/*guardo en la variable 'teclado' la entrada del teclado
													y todo texto recibido ya sea mayuscula o minuscula lo convierte en minuscula*/
	
	numeros="0123456789 qwertyuiopasdfghjklñzxcvbnmáéíóú";
	
	especiales="8-37-38-46-164";//espacio - flecha para la izquierda - flecha para la derecha - suprimir - eñe
	
	teclado_especial=false;
		
	for(var i in especiales){//busco tecla presionada en array especiales
		if(key==especiales[i]){
			teclado_especial=true;
			break;
		}
	}
	
	if(numeros.indexOf(teclado)==-1 && !teclado_especial){//verifico que el caracter esta dentro de la cadena (numeros y especiales)
		return false;
	}	
}

//VALIDA BUSQUEDA
function ValidarRegistroComun(){
		var nombre=document.getElementById("txtNombre");
			var lblnombre=document.getElementById("lblNombre");
		var nombreU=document.getElementById("txtNomUser");
			var lblnombreU=document.getElementById("lblNomUser");
		var apellido=document.getElementById("txtApellido");
			var lblapellido=document.getElementById("lblApellido");
		var email=document.getElementById("txtEmail");
			var lblemail=document.getElementById("lblEmail");
		var contrasena=document.getElementById("pswContrasena");
			var lblcontrasena=document.getElementById("lblContrasena");
		var vericontrasena=document.getElementById("pswVeriContrasena");
			var lblvericontrasena=document.getElementById("lblVeriContrasena");
			
	//NOMBRE
	if(nombre.value==""){
		nombre.style.borderColor = "red";
		lblnombre.style.color = "red";		
		$("#nonombreC").fadeIn();
		$("#longnombreC").fadeOut();
		$("#malnombreC").fadeOut();
		return false;
	}else{
		if(nombre.value.length > 50 ) { //el campo tiene que tener mas de 50 digitos
			nombre.style.borderColor = "red";
			lblnombre.style.color = "red";
			$("#nonombreC").fadeOut();
			$("#longnombreC").fadeIn();
			$("#malnombreC").fadeOut();
			return false;
		} 
	
		if(/^\s+|\s+$/.test(nombre.value)){//evito que el campo se llene de espacios en blanco
			nombre.style.borderColor = "red";
			lblnombre.style.color = "red";
			$("#nonombreC").fadeOut();
			$("#longnombreC").fadeOut();
			$("#malnombreC").fadeIn();
			return false;
		}
		$("#nonombreC").fadeOut();
		$("#longnombreC").fadeOut();
		$("#malnombreC").fadeOut();
		nombre.style.borderColor = "#a4b97f";
		lblnombre.style.color = "black";
	}
	
	//APELLIDO
	if(apellido.value==""){
		apellido.style.borderColor = "red";
		lblapellido.style.color = "red";
		$("#noapelC").fadeIn();
		$("#longapelC").fadeOut();
		$("#malapelC").fadeOut();
		return false;
	}else{
		if(apellido.value.length > 50 ) { //el campo tiene que tener mas de 50 digitos
			apellido.style.borderColor = "red";
			lblapellido.style.color = "red";
			$("#noapelC").fadeOut();
			$("#longapelC").fadeIn();
			$("#malapelC").fadeOut();
			return false;
		} 
	
		if(/^\s+|\s+$/.test(apellido.value)){//evito que el campo se llene de espacios en blanco
			apellido.style.borderColor = "red";
			lblapellido.style.color = "red";
			$("#noapelC").fadeOut();
			$("#longapelC").fadeOut();
			$("#malapelC").fadeIn();
			return false;
		}
		$("#noapelC").fadeOut();
		$("#longapelC").fadeOut();
		$("#malapelC").fadeOut();
		apellido.style.borderColor = "#a4b97f";
		lblapellido.style.color = "black";
	}
	
	//NOMBRE DE USUARIO
	if(nombreU.value==""){
		nombreU.style.borderColor = "red";
		lblnombreU.style.color = "red";		
		$("#nonombreUC").fadeIn();
		$("#longnombreUC").fadeOut();
		$("#malnombreUC").fadeOut();
		return false;
	}else{
		if(nombreU.value.length > 50 ) { //el campo tiene que tener mas de 50 digitos
			nombreU.style.borderColor = "red";
			lblnombreU.style.color = "red";
			$("#nonombreUC").fadeOut();
			$("#longnombreUC").fadeIn();
			$("#malnombreUC").fadeOut();
			return false;
		} 
	
		if(/^\s+|\s+$/.test(nombreU.value)){//evito que el campo se llene de espacios en blanco
			nombreU.style.borderColor = "red";
			lblnombreU.style.color = "red";
			$("#nonombreUC").fadeOut();
			$("#longnombreUC").fadeOut();
			$("#malnombreUC").fadeIn();
			return false;
		}
		$("#nonombreUC").fadeOut();
		$("#longnombreUC").fadeOut();
		$("#malnombreUC").fadeOut();
		nombreU.style.borderColor = "#a4b97f";
		lblnombreU.style.color = "black";
	}
		
	//EMAIL
	if(email.value==""){
		email.style.borderColor = "red";
		lblemail.style.color = "red";
		$("#noemailC").fadeIn();
		$("#longemailC").fadeOut();
		$("#malemailC").fadeOut();
		return false;
	}else{
		if(email.value.length > 50 ) { //el campo tiene que tener mas de 50 digitos
			email.style.borderColor = "red";
			lblemail.style.color = "red";
			$("#noemailC").fadeOut();
			$("#longemailC").fadeIn();
			$("#malemailC").fadeOut();
			return false;
		} 
	
		if( !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email.value)) ){//letras + punto o guion + arroba + letras + punto + letras
			email.style.borderColor = "red";
			lblemail.style.color = "red";
			$("#noemailC").fadeOut();
			$("#longemailC").fadeOut();
			$("#malemailC").fadeIn();
			return false;
		}
		$("#noemailC").fadeOut();
		$("#longemailC").fadeOut();
		$("#malemailC").fadeOut();
		email.style.borderColor = "#a4b97f";
		lblemail.style.color = "black";
	}
	
	//CONTRASEÑA
	if(contrasena.value==""){
		contrasena.style.borderColor = "red";
		lblcontrasena.style.color = "red";
		$("#nopswC").fadeIn();
		$("#longpswC").fadeOut();
		$("#malpswC").fadeOut();
		$("#minpswC").fadeOut();
		return false;
	}else{
		if(contrasena.value.length > 50 ) { //el campo tiene que tener mas de 50 digitos
			contrasena.style.borderColor = "red";
			lblcontrasena.style.color = "red";
			$("#nopswC").fadeOut();
		    $("#longpswC").fadeIn();
		    $("#malpswC").fadeOut();
		    $("#minpswC").fadeOut();
			return false;
		}
	
		if(/^\s+|\s+$/.test(contrasena.value)){//evito que el campo se llene de espacios en blanco
			contrasena.style.borderColor = "red";
			lblcontrasena.style.color = "red";
			$("#nopswC").fadeOut();
		    $("#longpswC").fadeOut();
		    $("#malpswC").fadeIn();
		    $("#minpswC").fadeOut();
			return false;
		}
		if(contrasena.value.length<6){//contraseña no puede tener menos de 6 digitos
			contrasena.style.borderColor = "red";
			lblcontrasena.style.color = "red";
			$("#nopswC").fadeOut();
		    $("#longpswC").fadeOut();
		    $("#malpswC").fadeOut();
		    $("#minpswC").fadeIn();
			return false;
		}
		$("#nopswC").fadeOut();
		$("#longpswC").fadeOut();
		$("#malpswC").fadeOut();
		$("#minpswC").fadeOut();
		contrasena.style.borderColor = "#a4b97f";
		lblcontrasena.style.color = "black";
	}
	
	//VERIFICACION DE CONTRASEÑA
	if(vericontrasena.value==""){
		vericontrasena.style.borderColor = "red";
		lblvericontrasena.style.color = "red";
		$("#nopsw2C").fadeIn();
		$("#malpsw2C").fadeOut();
		return false;
	}else{
		if(vericontrasena.value!=contrasena.value){//la verificacion tiene que ser igual a la contraseña
			vericontrasena.style.borderColor = "red";
			lblvericontrasena.style.color = "red";
			$("#nopsw2C").fadeOut();
		    $("#malpsw2C").fadeIn();
			return false;
		}
		$("#nopsw2C").fadeOut();
		$("#malpsw2C").fadeOut();
		vericontrasena.style.borderColor = "#a4b97f";
		lblvericontrasena.style.color = "black";
	}

	return true;
}

//VALIDA BUSQUEDA
function ValidarEditUser(){
		var nombre=document.getElementById("txtNombre");
			var lblnombre=document.getElementById("lblNombre");
		var nombreU=document.getElementById("txtNomUser");
			var lblnombreU=document.getElementById("lblNomUser");
		var apellido=document.getElementById("txtApellido");
			var lblapellido=document.getElementById("lblApellido");
		var email=document.getElementById("txtEmail");
			var lblemail=document.getElementById("lblEmail");
			
	//NOMBRE

		if(nombre.value.length > 50 ) { //el campo tiene que tener mas de 50 digitos
			nombre.style.borderColor = "red";
			lblnombre.style.color = "red";
			$("#longnombreC").fadeIn();
			$("#malnombreC").fadeOut();
			return false;
		} 
	
		if(/^\s+|\s+$/.test(nombre.value)){//evito que el campo se llene de espacios en blanco
			nombre.style.borderColor = "red";
			lblnombre.style.color = "red";
			$("#longnombreC").fadeOut();
			$("#malnombreC").fadeIn();
			return false;
		}
		$("#longnombreC").fadeOut();
		$("#malnombreC").fadeOut();
		nombre.style.borderColor = "#a4b97f";
		lblnombre.style.color = "black";

	
	//APELLIDO

		if(apellido.value.length > 50 ) { //el campo tiene que tener mas de 50 digitos
			apellido.style.borderColor = "red";
			lblapellido.style.color = "red";
			$("#longapelC").fadeIn();
			$("#malapelC").fadeOut();
			return false;
		} 
	
		if(/^\s+|\s+$/.test(apellido.value)){//evito que el campo se llene de espacios en blanco
			apellido.style.borderColor = "red";
			lblapellido.style.color = "red";
			$("#longapelC").fadeOut();
			$("#malapelC").fadeIn();
			return false;
		}
		$("#longapelC").fadeOut();
		$("#malapelC").fadeOut();
		apellido.style.borderColor = "#a4b97f";
		lblapellido.style.color = "black";
	
	//NOMBRE DE USUARIO
		if(nombreU.value.length > 50 ) { //el campo tiene que tener mas de 50 digitos
			nombreU.style.borderColor = "red";
			lblnombreU.style.color = "red";
			$("#longnombreUC").fadeIn();
			$("#malnombreUC").fadeOut();
			return false;
		} 
	
		if(/^\s+|\s+$/.test(nombreU.value)){//evito que el campo se llene de espacios en blanco
			nombreU.style.borderColor = "red";
			lblnombreU.style.color = "red";
			$("#longnombreUC").fadeOut();
			$("#malnombreUC").fadeIn();
			return false;
		}
		$("#longnombreUC").fadeOut();
		$("#malnombreUC").fadeOut();
		nombreU.style.borderColor = "#a4b97f";
		lblnombreU.style.color = "black";
		
	//EMAIL
		if(email.value.length > 50 ) { //el campo tiene que tener mas de 50 digitos
			email.style.borderColor = "red";
			lblemail.style.color = "red";
			$("#longemailC").fadeIn();
			$("#malemailC").fadeOut();
			return false;
		} 
	if(email.value!=""){
		if( !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email.value)) ){//letras + punto o guion + arroba + letras + punto + letras
			email.style.borderColor = "red";
			lblemail.style.color = "red";
			$("#longemailC").fadeOut();
			$("#malemailC").fadeIn();
			return false;
		}
	}
		$("#noemailC").fadeOut();
		$("#longemailC").fadeOut();
		$("#malemailC").fadeOut();
		email.style.borderColor = "#a4b97f";
		lblemail.style.color = "black";

	return true;
}

function sendPrivateMessageFromInbox(event){
	event.preventDefault();
	//Traigo todo el contenido del mensaje
	var content = $("#message-content-fromInbox").val();

	var toUser = $("#toUserInbox").val().trim();

	$.post(
		"php/controllers/userCtrl.php",
		{ content : content, toUser : toUser, action:"sendPrivateMessage" },
		function(data){
			var data = JSON.parse(data);

			if(data.valid == true){
				//Actualizo el modal

				$("#message-content-fromInbox").val("");
				$('#messageFromInbox-reload').load('./php/views/inboxChat.php?usuarioRemitent='+toUser,
					function(){
						$("#message-area-inbox").scrollTop($("#message-area-inbox")[0].scrollHeight);
					});
			}
			else{
				console.log(data.errorMsg);
				$('#modalMessages').find('.modal-title').html("OH NO!");
				$('#modalMessages').find('.modal-body').html(data.errorMsg)
				$('#modalMessages').find('.modal-footer').html("");
				$('#modalMessages').modal('toggle');
			};
		} );
}

function sendPrivateMessage(event){
	event.preventDefault();
	//Traigo todo el contenido del mensaje
	var content = $("#message-content").val();

	var toUser = $("#userRecipient").val().trim();


	$.post(
		"php/controllers/userCtrl.php",
		{ content : content, toUser : toUser, action:"sendPrivateMessage" },
		function(data){
			var data = JSON.parse(data);

			if(data.valid == true){
				//Actualizo el modal

				$("#message-content").val("");
				$('#message-reload').load('./php/views/inboxChat.php?usuarioRemitent='+toUser,
					function(){
						$("#message-area-private").scrollTop($("#message-area-private")[0].scrollHeight);
					});
			}
			else{
				console.log(data.errorMsg);
				$('#modalMessages').find('.modal-title').html("OH NO!");
				$('#modalMessages').find('.modal-body').html(data.errorMsg)
				$('#modalMessages').find('.modal-footer').html("");
				$('#modalMessages').modal('toggle');
			};
		} );
}

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
	$.post( "php/controllers/postMessageCtrl.php", { content : content, toUser : toUser }, showInConsole );
}

function openPrivateMessageModal(event){
	event.preventDefault();

	var toUserId = $("#modalPrivateMessages").find("#userRecipient").val();

	console.log(toUserId);

	$('#message-reload').load('./php/views/inboxChat.php?usuarioRemitent='+toUserId,
		function(){
			$("#message-area-private").scrollTop($("#message-area-private")[0].scrollHeight);
		});

	$('#modalPrivateMessages').modal('toggle');

}

function openPrivateMessageModalFromInbox(){
	var toUserId = $(this).find(".propIdBandeja").val();
	var toUserName = $(this).find(".propNombreBandeja").val();
	var toUserSurname = $(this).find(".propApellidoBandeja").val();

	$('#modalPrivateMessagesInbox').find('.modal-title').text(toUserName + " " + toUserSurname);
	$('#modalPrivateMessagesInbox').find('#toUserInbox').val(toUserId);

	console.log(toUserId);

	$('#messageFromInbox-reload').load('./php/views/inboxChat.php?usuarioRemitent='+toUserId ,
		function(){
			$("#message-area-inbox").scrollTop($("#message-area-inbox")[0].scrollHeight);
		});

	$('#modalPrivateMessagesInbox').modal('show');

}

function openInboxModal(event){
	event.preventDefault();

	$('#modalInbox').modal('toggle');
}

function showInConsole(data){
	console.log(data);
}


// LIMITADOR CARACTERES // Mensajes del Muro

var limite = 200; // número máximo de caracteres

$("#messageWall-content").keyup(function(event) {// cada vez que se deja de presionar una tecla
	var box = $(this).val();// obtiene el texto que está escrito en el textarea
	var value = (box.length *100) / limite;// calcula el porcentaje entre el texto ingresado y el límite
	var resta = limite - box.length;// obtiene cuántos caracteres quedan
	// si aún no se llegó al límite
	if(box.length <= limite) {
	    $('#countdownWall').html(resta + ' caracteres disponibles');// modifica el texto que muestra la cantidad de caracteres que restan
	    // si no se llegó al 50%, hace que la barra sea de color verde
	    if (value < 50) {
	        $('#divmessageWall').removeClass();
	        $('#divmessageWall').addClass('has-success');
	    }
	    else if (value < 85) { // si no se llegó al 85% que sea amarilla
	        $('#divmessageWall').removeClass();
	        $('#divmessageWall').addClass('has-warning has-feedback');
	    }
	    else { // si se superó el 85% que sea roja
	        $('#divmessageWall').removeClass();
	        $('#divmessageWall').addClass('has-error has-feedback');
	    };
	}
	else // si se llegó al límite no permite ingresar más caracteres
	{
		$(this).val($(this).val().substr(0, limite));// evita que se ingresen más caracteres
	    event.preventDefault();// evita que se ingresen más caracteres
	}               
});	


// Mensajes Privados

var limite = 200;// número máximo de caracteres

    // cada vez que se deja de presionar una tecla
$("#message-content").keyup(function(event) {
	var box = $(this).val();// obtiene el texto que está escrito en el textarea
	var value = (box.length *100) / limite;// calcula el porcentaje entre el texto ingresado y el límite
	var resta = limite - box.length;// obtiene cuántos caracteres quedan
	// si aún no se llegó al límite
	if(box.length <= limite) {
	    $('#countdownPrivate').html(resta + ' caracteres disponibles');// modifica el texto que muestra la cantidad de caracteres que restan
	    // si no se llegó al 50%, hace que el borde del text sea de color verde
	    if (value < 50) {
	        $('#divmessagePrivate').removeClass();
	        $('#divmessagePrivate').addClass('has-success');
	    }
	    else if (value < 85) { // si no se llegó al 85% que sea amarillo
	        $('#divmessagePrivate').removeClass();
	        $('#divmessagePrivate').addClass('has-warning');
	    }
	    else { // si se superó el 85% que sea rojo
	        $('#divmessagePrivate').removeClass();
	        $('#divmessagePrivate').addClass('has-error');
	    };
	}
	else // si se llegó al límite no permite ingresar más caracteres
	{
		$(this).val($(this).val().substr(0, limite));// evita que se ingresen más caracteres
	    event.preventDefault();
	}               
});
