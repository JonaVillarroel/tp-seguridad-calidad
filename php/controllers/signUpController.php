<?php
	require(dirname(__DIR__)."/domain/User.php");

	//TOMA DE VALORES DE CAMPOS DE FORMULARIO
	$name = $_POST ["name"];
	$surname = $_POST ["surname"];
	$mail = $_POST ["mail"];
	$userName = $_POST ["userName"];
	$pass = $_POST ["pass"];
	$repass = $_POST ["repass"];
	//FIN DE TOMA DE VALORES DE LOS CAMPOS DEL FORMULARIO

	$user = new User();
	$user -> SignUp($name,$surname,$mail,$userName,$pass,$repass);
?>