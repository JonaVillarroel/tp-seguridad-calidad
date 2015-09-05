<?php
require './php/domain/Session.php';
$mysession = new Session();
$mysession->initSession();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : false;
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
    Deberia tener un menú con
    -Enlace a Control de Usuarios (pendientes de alta y registrados y dados de baja)
</div>

<?php
        include_once (__DIR__."/templates/footer.php");
    ?>

<script src="lib/jquery-ui/external/jquery/jquery.js"></script>
<script src="lib/jquery-ui/jquery-ui.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>