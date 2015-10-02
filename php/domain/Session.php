<?php

//Para prevenir robo de sesion
// Previene ataque xss para robar el identificador de sesion


	class Session{
		public function __construct(){}
		
		public function initSession(){
			//Para prevenir robo de sesion
			// Previene ataque xss para robar el identificador de sesion
			ini_set('session.cookie_httponly', 1);

			// **PREVENTING SESSION FIXATION**
			// Id de sesion no puede ser pasada por url
			ini_set('session.use_only_cookies', 1);

			// Usa una conexion segura (HTTPS) si es posible
			ini_set('session.cookie_secure', 1);
			@session_start();
		}
		
		public function setSession($varname, $value){
			$_SESSION[$varname] = $value;
		}
		
		public function destroySession(){
			session_unset();
			session_destroy();
		}
	
	}
?>