<?php
    require_once (dirname(__DIR__)."/domain/Message.php");
    require_once (dirname(__DIR__)."/services/UserRepositoryService.php");
  	require_once (dirname(__DIR__)."/domain/Session.php");
    require_once (dirname(__DIR__)."/services/WallRepositoryService.php");
	$mysession = new Session();
	$mysession->initSession();


    $toUser = $_POST["toUser"];

    $content = $_POST["content"];
    #el id 1 pertenece al usuario anonimo
    $fromUser = isset($_SESSION['id']) ? $_SESSION['id'] : 1;

    $toWall = $_POST["toWall"];

    if($rows < $limiteMuro) {
        $message = new Message($content, $toWall, $fromUser);
    }else{
        echo "FLAG";
    }
	header ('location: ../../index.php?usuario='.$toUser);
	
?>
