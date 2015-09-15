<?php
    require_once (dirname(__DIR__)."/domain/Message.php");
    require_once (dirname(__DIR__)."/services/UserRepositoryService.php");
  	require_once (dirname(__DIR__)."/domain/Session.php");
	$mysession = new Session();
	$mysession->initSession();


    $toUser = $_POST["toUser"];

    $content = $_POST["content"];
    $fromUser = isset($_SESSION['id']) ? $_SESSION['id'] : 1;

    $toWall = $_POST["toWall"];
	
	$message = new Message($content, $toWall, $fromUser);
	
	header ('location: ../../index.php?usuario='.$toUser);
	
?>
