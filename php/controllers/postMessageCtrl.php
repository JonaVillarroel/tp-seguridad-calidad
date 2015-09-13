<?php
    require_once (dirname(__DIR__)."/domain/Message.php");
    require_once (dirname(__DIR__)."/services/WallRepositoryService.php");
  	require_once (dirname(__DIR__)."/domain/Session.php");
	$mysession = new Session();
	$mysession->initSession();

    $toUser = $_POST["toUser"];

    $content = $_POST["content"];
    $fromUser = isset($_SESSION['id']) ? $_SESSION['id'] : 1;
	
	//Obtengo el id_muro que pertenece al user con id $toUser
	$wallRepo = new WallRepositoryService();

    $toWall = $wallRepo -> getWallIdById($toUser);
	
	$message = new Message($content, $toWall, $fromUser);
	
	header ('location: ../../index.php?usuario='.$toUser);
	
?>
