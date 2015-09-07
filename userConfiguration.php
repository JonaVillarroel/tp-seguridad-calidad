<?php
require './php/domain/Session.php';
$mysession = new Session();
$mysession->initSession();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$usersurname = isset($_SESSION['userSurname']) ? $_SESSION['userSurname'] : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Panel de administracion</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="icon" type="image/png" href="img/muroBlanco.png">
</head>
<body>
<?php
            include_once (__DIR__."/templates/header.php");
?>
	<div class="container">
        <h2 class="text-info">Configuración de usuario</h2>
        <h4>Quién puede ver y escribir en mi muro</h4>

        <?php
        include_once (__DIR__."/php/views/userConfigView.php");
        ?>

        <a href="#" id="modifyConfigurationBtn" class="btn btn-success">Aceptar cambios</a>
	</div>

<?php
            include_once (__DIR__."/templates/footer.php");
?>
<script src="lib/jquery-ui/external/jquery/jquery.js"></script>
<script src="lib/jquery-ui/jquery-ui.min.js"></script>
<script src="js/main.js"></script>
<script src="js/UpdateWallConfig.js"></script>

</body>
</html>