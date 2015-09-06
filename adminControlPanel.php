<?php
require './php/domain/Session.php';
$mysession = new Session();
$mysession->initSession();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : false;
//$roles = isset($_SESSION['rol']) ? $_SESSION['roles'] : false;

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
<div class="container ">
<h2>Panel de administración</h2>

	<ul class="nav nav-tabs">
  <li onClick="cargarDatos()" class="active"><a data-toggle="tab" href="#home">Usuarios registrados</a></li>
  <li><a data-toggle="tab" href="#menu1">Solicitudes pendientes</a></li>
  
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <h3></h3>
    <table class="table table-striped">
				        <thead>
				           <tr>
                     <th>ID usuario</th>
                     <th>Rol</th> 
				             <th>Nombre</th>
				             <th>Apellido</th>
				             <th>Mail</th>
                     <th>Nombre de usuario</th>
				             <th>Estado</th>

				             
				           </tr>
				        </thead>
						 <?php 
							require ("consulta_class.php");

							$consulta = new Consulta();
							$consulta->showRegisteredUsers();

						 ?>

					</table>
  </div>
  <div id="menu1" class="tab-pane fade">
    <h3>Solicitudes pendientes</h3>
    

  <table class="table table-striped">
                <thead>
                   <tr>
                     <th>ID usuario</th>
                     <th>Rol</th> 
                     <th>Nombre</th>
                     <th>Apellido</th>
                     <th>Mail</th>
                     <th>Nombre de usuario</th>
                     <th>Estado</th>
                     <th>Aceptar solicitud</th>
        
                   </tr>
                </thead>
             <?php 
          

              $consulta = new Consulta();
              $consulta->showRequestList();

             ?>

          </table>
          <button class="btn btn-info">Actualizar cambios</button>
  </div>

</div>

</div>
<?php
            include_once (__DIR__."/templates/footer.php");
?>
<script src="lib/jquery-ui/external/jquery/jquery.js"></script>
<script src="lib/jquery-ui/jquery-ui.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>