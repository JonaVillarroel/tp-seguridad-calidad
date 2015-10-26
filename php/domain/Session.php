<?php
//Para prevenir robo de sesion
// Previene ataque xss para robar el identificador de sesion
ini_set('session.cookie_httponly', 1);
// para preveinir Session fixation
// Id de sesion no puede ser pasada por url
ini_set('session.use_only_cookies', 1);
//6 bits por caracter,mayor cantidad de combinaciones.
ini_set('session.hash_bits_per_character',6);
// Especifica el algoritmo de hash usado para el id de sesion, 0=MD5, 1=SHA1
ini_set('session.hash_function', 1);

	class Session{

		public function __construct(){}
		
		public function initSession(){
			session_id();
			@session_start();

			//tiempo de vida de la sesión.

			$time = $_SERVER['REQUEST_TIME'];
			//tiempo de vida de la sesión(30 minutos).
			$timeout_duration = 1800;

			//Busco la ultima actividad del usuario, si esta seteada y $timeout_duration expiró, cierro la sesión y
			//lo redirijo a una página avisando lo sucedido.
			if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {

			 header('location: php/controllers/exitController.php');

			}
			    
			//actualizo la variable por lo que el timeout estará basado en ella, y 
			//no cuando cuando el usuario inicie sesión.
			$_SESSION['LAST_ACTIVITY'] = $time;

		}
		
		public function setSession($varname, $value){

			$_SESSION[$varname] = $value;
		}
	
		public function destroySession(){
			session_unset();
			session_destroy();
			session_write_close();
    		setcookie(session_name(),'',0,'/');
    		//regenera el id y el anterior lo elimina
    		session_regenerate_id(true);
		}
	}
?>