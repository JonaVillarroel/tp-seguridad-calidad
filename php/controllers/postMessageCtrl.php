<?php
    require_once (dirname(__DIR__)."/domain/User.php");
require_once (dirname(__DIR__)."/domain/Wall.php");
    $toUser = $_REQUEST['toUser'];
    $content = $_REQUEST['content'];
    $user = new User();
    $wall = new Wall();

    //Obtengo el id_usuario que está enviando el mensaje
    $fromUser = $_SESSION['usuario']['id'];

    //Obtengo el id_muro que pertenece al user con nombre $toUser
    $toWall = $wall->getWallByUser($toUser);

    $user -> postMessage($content, $fromUser, $toWall);
?>
