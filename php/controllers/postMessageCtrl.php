<?php
    require_once (dirname(__DIR__)."/domain/User.php");
    require_once (dirname(__DIR__)."/services/WallRepositoryService.php");

    $toUser = $_POST["toUser"];
    $content = $_POST["content"];
    $fromUser = $_POST["fromUser"];
	
	//Obtengo el id_muro que pertenece al user con id $toUser
	$wallRepo = new WallRepositoryService();
    $toWall = $wallRepo -> getWallIdById($toUser);
	
	$user = new User();
	$user -> postMessage($content,$fromUser,$toWall);
	
	header ('location: ../../index.php?usuario='.$toUser);
	
?>
