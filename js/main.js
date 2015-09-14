$(document).ready(function(){

	$('#sendMessageBtn').click(sendPrivateMessage);
	$('#postMessageBtn').click(postMessage);
	$('#privateMessageModalBtn').click(openPrivateMessageModal);

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


function sendPrivateMessage(){
	//Traigo todo el contenido del mensaje
	var content = $("#privateMessage").val();

	//Obtengo el nombre de usuario al que se le destina el mensaje (el back lo consulta y obtiene de qué muro se trata)
	var pathname = window.location.pathname;
	var pathname_array = pathname.split("/");
	var toUser = pathname_array[pathname_array.length - 1];
	//Habria que hacer algo más acá para que le saque el ".php" al user.


	//Envio los datos al back para que el controller los procese
	//El id_usuario que envia el mensaje y el rol lo obtengo en el back desde las sessions.
	$.post(
		"php/controllers/userCtrl.php",
		{ content : content, toUser : toUser, action:"sendPrivateMessage" },
		showInConsole );
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

	$('#modalPrivateMessages').modal('toggle');
}

function showInConsole(data){
	console.log(data);
}