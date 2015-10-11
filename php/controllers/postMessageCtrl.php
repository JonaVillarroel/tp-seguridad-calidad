<?php
    require_once (dirname(__DIR__)."/domain/Message.php");
    require_once (dirname(__DIR__)."/services/UserRepositoryService.php");
  	require_once (dirname(__DIR__)."/domain/Session.php");
    require_once (dirname(__DIR__)."/domain/Wall.php");
    require_once (dirname(__DIR__)."/services/WallRepositoryService.php");

	$mysession = new Session();
	$mysession->initSession();

    $content = $_POST["content"];
    $toWall = $_POST["toWall"];

    $patron = "/^[[:digit:]]+$/";
    if(isset($_SESSION['id']) and preg_match($patron,$_SESSION['id'])) {
        $fromUser = $_SESSION['id'];
    }else{
        //El id 1 pertenece al usuario anonimo
        $fromUser = 1;
    }

    if(isset($_POST["toUser"]) and preg_match($patron,$_POST["toUser"])) {
        $toUser = $_POST["toUser"];
    }else{
        header ('location:index.php?error=4');
        exit;
    }
    echo "string";
    $wallRepo = new WallRepositoryService();
    $wallResult = $wallRepo -> getWallByUserId($toUser);
    if($row = $wallResult -> fetch_object()) {
        $wall = new Wall();
        $messages = $wall -> getMessages($row->limite_muro,$toUser);
            if (count($messages) < $row->limite_muro) {
                $message = new Message($content, $toWall, $fromUser);
                header ('location: ../../index.php?usuario='.$toUser);
            } else {
                header ('location: ../../index.php?usuario='.$toUser.'&alert');
            }
    }
	
?>
