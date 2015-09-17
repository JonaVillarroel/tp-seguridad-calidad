<?php
	require '../domain/Session.php';
	$mysession = new Session();
	$mysession->initSession();
	
	$mysession->destroySession();
	
	header('location: ../../index.php');
?>