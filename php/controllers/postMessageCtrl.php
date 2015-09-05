<?php
    require_once (dirname(__DIR__)."/domain/User.php");
    require_once (dirname(__DIR__)."/connection/Connection.php");

    $toUser = $_POST['toUser'];
    $content = $_POST['content'];
    $user = new User();
    $db = new Connection();


    //Obtengo el id_usuario que está enviando el mensaje
    $fromUser = $_SESSION['userId'];

    //Obtengo el id_muro que pertenece al user con nombre $toUser
    $query = "SELECT id_muro FROM MURO INNER JOIN USUARIO ON
                        MURO.id_usuario = USUARIO.id_usuario
                        WHERE USUARIO.nombre_usuario = '$userName'";

    $results = $db -> query($query)
    or die('Error consultando el usuario: ' . mysqli_error($this->db));

    $obj = $results -> fetch_object();

    $toWall = $obj -> id_muro;

    $user -> postMessage($content, $fromUser, $toWall);
?>
