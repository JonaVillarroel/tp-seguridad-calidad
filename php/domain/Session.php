<?php

//Para prevenir robo de sesion
// Previene ataque xss para robar el identificador de sesion


	class Session{
		public function __construct(){}
		
		public function initSession(){
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