<?php
    require(dirname(__DIR__)."/domain/User.php");

    $mail = $_POST ["mail"];
    $pass = $_POST ["pass"];

    $user = new User();
    $user -> Login($mail, $pass);
?>