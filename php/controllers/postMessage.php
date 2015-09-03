<?php
    require (dirname(__DIR__)."/domain/User.php");
    $json = $_REQUEST['datos'];
    $data = json_decode($json, true);
    $user = new Usuario();
    $user -> postMessage($data);
?>

<!--No se donde concha meter esto así que lo puse en controllers, pero no es un controller mvc
-->