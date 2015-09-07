<?php
require(dirname(__DIR__)."/connection/Connection.php");
    $content = $_POST["contenido"];
    $idMuro = $_POST["idmuro"];
    $idUser = $_POST["iduser"];
    $query = "INSERT INTO MENSAJE (id_usuario,id_muro,contenido) VALUES ('$idUser','$idMuro','$content');";
    $myconnection = new Connection();
    $result = $myconnection -> query($query);
    header ('location: ../../index.php?usuario='.$idUser);
    $myconnection -> close();
?>