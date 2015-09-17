<?php
	require(dirname(__DIR__)."/domain/User.php");
	
	$user = new User();
	$userId = $_GET['id'];

	$name = $_POST ["name"];
	$surname = $_POST ["surname"];
	$mail = $_POST ["mail"];
	$userName = $_POST ["userName"];

	$user -> modifyUser($userId,$name,$surname,$mail,$userName);
	
?>