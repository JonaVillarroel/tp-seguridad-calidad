<?php
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