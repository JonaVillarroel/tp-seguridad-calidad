<?php
require './php/domain/Session.php';
    
    $mysession = new Session();
    $mysession->initSession();

    $nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : false;
    $userLoggedId = isset($_SESSION['id']) ? $_SESSION['id'] : false;

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
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/UpdateWallConfig.js"></script>

</body>
</html>