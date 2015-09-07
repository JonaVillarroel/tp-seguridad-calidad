<?php
	require(dirname(__DIR__)."/domain/User.php");
	
	$user = new User();
	$userId = $_GET['id'];

	$user -> approveUser($userId);
	
?>