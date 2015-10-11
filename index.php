<?php
    require './php/domain/Session.php';

    $mysession = new Session();
    $mysession->initSession();
    $patron = "/^[[:digit:]]+$/";

    $nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : false;
    $userLoggedId = isset($_SESSION['id']) ? $_SESSION['id'] : false;

    if (isset($_GET['usuario']) and preg_match($patron,$_GET['usuario'])){
        $usuarioConsultado = $_GET['usuario'];
    }else{
        $usuarioConsultado = false;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>The Wall</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link rel="icon" type="image/png" href="img/muroBlanco.png">
    </head>

    <body>
	<?php
        include_once (__DIR__."/templates/header.php");
    ?>
	<div class="container bg">
        <?php
            if($usuarioConsultado){
                include_once (__DIR__."/templates/wall.php");
            }else{
                include_once (__DIR__."/templates/welcome.php");
            }
        ?>
	</div>

    <?php


    if(isset($_SESSION['id'])){
        if($_SESSION['id'] != $usuarioConsultado){
            require_once (__DIR__."/templates/modalPrivateMessages.php");
        }
    };

    ?>

    <?php

    if(isset($_SESSION['id']))
    {
        require_once (__DIR__."/templates/modalInbox.php");
        require_once (__DIR__."/templates/modalPrivateMessagesInbox.php");
    };

    ?>

    <div class="modal fade bs-example-modal-sm" id="modalMessages" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">OH NO!</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <?php
        include_once (__DIR__."/templates/footer.php");
    ?>


    <script src="lib/jquery-ui/external/jquery/jquery.js"></script>
    <script src="lib/jquery-ui/jquery-ui.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script src="js/main.js"></script>
    </body>
</html>