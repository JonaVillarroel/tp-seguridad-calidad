<?php
require './php/domain/Session.php';
$mysession = new Session();
$mysession->initSession();

$username = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : false;
$roles = isset($_SESSION['roles']) ? $_SESSION['roles'] : false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Wall</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css"></link>
    <link rel="stylesheet" type="text/css" href="css/main.css"></link>
    <link rel="icon" type="image/png" href="img/muroBlanco.png">
</head>

<body>

<div class="container bg">
    Deberia contener una tabla con todos los usuarios indicando su estado.
    Deberia poder seleccionarse de a uno o muchos para darlos de alta o baja.
</div>

<?php
include_once (__DIR__."/templates/footer.php");
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

<script src="lib/jquery-ui/external/jquery/jquery.js"></script>
<script src="lib/jquery-ui/jquery-ui.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>