<?php
	require '../domain/Session.php';
	$mysession = new Session();
	$mysession->initSession();
	
	$mysession->destroySession();
	
	header('location: http://localhost:8080/tp-seguridad-calidad/index.php');
?>