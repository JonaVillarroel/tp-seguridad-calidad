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

        <div class="radio wallconfiguration">
          <label><input type="radio" name="optradio" value="opt-1">Sólo pueden acceder usuarios enumerados</label>
          <input type="text" placeholder="Escribe un nombre" id="item-opt-1">
            <a href="#" id="addItemList-1" class="btn btn-success">Agregar</a>
            <ul class="list-group list-1">

            </ul>
        </div>
        <div class="radio wallconfiguration">
          <label><input type="radio" name="optradio" value="opt-2">Pueden acceder todos los usuarios  pero solo agregar mensajes
        aquellos enumerados</label>
          <input type="text" placeholder="Escribe un nombre" id="item-opt-2">
            <a href="#" id="addItemList-2" class="btn btn-success">Agregar</a>
            <ul class="list-group list-2">
                <li class="list-group-item">CosmeFulanito</li>
            </ul>
        </div>
        <div class="radio wallconfiguration ">
          <label><input type="radio" name="optradio" value="opt-3" >Todos los usuarios del sistema pueden acceder y publicar contenido</label>
        </div>

        <div class="radio wallconfiguration">
          <label><input type="radio" name="optradio" value="opt-4">Usuarios anónimos pueden leer contenido.</label>
        </div>

        <div class="radio wallconfiguration">
          <label><input type="radio" name="optradio" value="opt-5">Usuarios anónimos pueden crear y leer contenido.</label>
        </div>

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