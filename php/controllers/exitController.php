<?php
	require '../domain/Session.php';
	$mysession = new Session();
	$mysession->initSession();
	//ANTI CSRF
	 if (isset($_GET["csrf"]) && $_GET["csrf"] == $_SESSION["token"]) {
        $_SESSION = array();
     
	$mysession->destroySession();
	}else{
		header('location: ../../index.php?error=4');
		exit();
		 }

	header('location: ../../index.php');
	exit();
?>
