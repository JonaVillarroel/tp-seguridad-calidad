<?php
	require(dirname(__DIR__)."/domain/User.php");
	
	$user = new InboxRepositoryService();
	$userId = $_GET['id'];

	$limite = $_POST ["MsjPrivLimit"];

	$user -> modifyLimitInbox($userId, $limite);
	
?>