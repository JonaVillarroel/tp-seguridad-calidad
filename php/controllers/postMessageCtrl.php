<?php
    require_once (dirname(__DIR__)."/domain/User.php");
    require_once (dirname(__DIR__)."/connection/Querybuilder.php");
    $toUser = $_REQUEST['toUser'];
    $content = $_REQUEST['content'];
    $user = new User();
    $qb = new Querybuilder();

    //Obtengo el id_usuario que está enviando el mensaje
    $fromUser = $_SESSION['usuario']['id'];

    //Obtengo el id_muro que pertenece al user con nombre $toUser
    $result = $qb->simple_select('MURO', 'id_muro', 'id_usuario', $fromUser);

    $data = mysql_fetch_array($result) or die(mysql_error());

    $toWall = $data['id_muro'];

    $user -> postMessage($content, $fromUser, $toWall);
?>
