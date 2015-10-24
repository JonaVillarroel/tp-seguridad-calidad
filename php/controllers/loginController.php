<?php
    require(dirname(__DIR__)."/domain/User.php");

    $mail = $_POST ["mail"];
    $pass = $_POST ["pass"];
    if(!$mail || !$pass){
        header ('location: ../../index.php?error=1s');
        exit;
    }


    if((preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/",$mail)) and (preg_match("/[\w]{6,15}/",$pass))) {
        $user = new User();
        $user->Login($mail, $pass);
    }else{
        header ('location: ../../index.php?error=4');
        exit;
    }
?>