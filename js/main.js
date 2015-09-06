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