<?php
    require_once (dirname(__DIR__)."/domain/User.php");
    require_once (dirname(__DIR__)."/servies/WallRepositoryService.php");

    $wallRepo = new WallRepositoryService();

    $toUser = $_POST['toUser'];
    $content = $_POST['content'];
    $user = new User();
    $db = new Connection();


    //Obtengo el id_usuario que está enviando el mensaje
    $fromUser = $_SESSION['userId'];

    //Obtengo el id_muro que pertenece al user con nombre $toUser

    $toWall = $wallRepo -> getWallIdByUserName($toUser);

    $user -> postMessage($content, $fromUser, $toWall);
?>
