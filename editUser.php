<?php
	//EVITO LOS WARNINGS DE VARIABLES NO DEFINIDAS
	$list = isset($_GET['list']) ? $_GET['list'] : null;

	$patron = "/^[[:digit:]]+$/";
	if(preg_match($patron,$_GET['id'])) {
		$userId = $_GET['id'];
	}else{
		header ('location: index.php?error=4');
		exit;
	}
?>
<?php
require './php/domain/Session.php';
$mysession = new Session();
$mysession->initSession();
$username = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
$usersurname = isset($_SESSION['apellido']) ? $_SESSION['apellido'] : null;
if($username == null or $usersurname == null){
	header ('location: index.php?error=2');
}

$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : null;
if($rol != 'Administrador'){
	header ('location: index.php?error=3');
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>On Wall</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css"></link>
        <link rel="stylesheet" type="text/css" href="css/main.css"></link>
    </head>

    <body>
	<?php
        include_once (__DIR__."/templates/header.php");
    ?>
	<?php
	require "./php/domain/User.php";
	$user = new User();
	$result = $user -> getUser($userId);
		
	if($row = $result -> fetch_object()) {
	?>
        <!--DIV FORMULARIO-->
		<div id="ContenedorFormulario">
		  <div id="ContenedorFormularioInterior">
			<div class="row">
				<div class="col-xs-12">
					<h1>Editando</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<span class="red">Datos anteriores</span>
				</div>
			</div>
			
				<form class="form-horizontal" method="post" onsubmit="return ValidarEditUser()" action="./php/controllers/modifyUserControllers.php?id=<?php echo $userId?>">
					<div class="col-xs-12 red center">
						<?php echo $row->nombre?>
					</div>
					<!--NOMBRE-->	  
					<div class="form-group">
						<label class="col-sm-4 control-label" id="lblNombre" for="txtNombre">Nombre:</label>
						<div class="col-sm-6 col-md-6">
							<input class="form-control" type="text" id="txtNombre"  name="name" onkeypress="return sololetras(event)" onpaste="return false"/>
							<div id="longnombreC" class="alert alert-danger">El Nombre debe tener menos de 50 caracteres</div>
							<div id="malnombreC" class="alert alert-danger">Por favor ingrese un Nombre v&aacute;lido</div>
						</div>
					</div>
					<div class="col-xs-12 red center">
						<?php echo $row->apellido?>
					</div>
					<!--APELLIDO-->
					<div class="form-group">
						<label class="col-sm-4 control-label" id="lblApellido" for="txtApellido">Apellido:</label>
						<div class="col-sm-6 col-md-6">
							<input class="form-control" type="text" id="txtApellido"  name="surname" onkeypress="return sololetras(event)" onpaste="return false"/>
							<div id="longapelC" class="alert alert-danger">El Apellido debe tener menos de 50 caracteres</div>
							<div id="malapelC" class="alert alert-danger">Por favor ingrese un Apellido v&aacute;lido</div>
						</div>
					</div>
					<div class="col-xs-12 red center">
						<?php echo $row->nombre_usuario?>
					</div>
					<!--NOMBRE DE USUARIO-->	  
					<div class="form-group">
						<label class="col-sm-4 control-label" id="lblNomUser" for="txtNomUser">Nombre de Usuario: <span class="red">*</span></label>
						<div class="col-sm-6 col-md-6">
							<input class="form-control" type="text" id="txtNomUser"  name="userName" onkeypress="return sololetras(event)" onpaste="return false"/>
							<div id="longnombreUC" class="alert alert-danger">El Nombre de Usuario debe tener menos de 50 caracteres</div>
							<div id="malnombreUC" class="alert alert-danger">Por favor ingrese un Nombre de Usuario v&aacute;lido</div>
						</div>
					</div>
					<div class="col-xs-12 red center">
						<?php echo $row->mail?>
					</div>
					<!--EMAIL-->
					<div class="form-group">
						<label class="col-sm-4 control-label marginright" id="lblEmail" for="txtEmail">Email:</label>
						<div id="DivEmail" class="input-group col-md-6">
							<span class="input-group-addon">@</span>
							<input class="form-control" type="text" id="txtEmail" name="mail"/>
							<div id="longemailC" class="alert alert-danger">El EMail debe tener menos de 50 caracteres</div>
							<div id="malemailC" class="alert alert-danger">Por favor ingrese un EMail v&aacute;lido</div>
						</div>
					</div>
					<!--BOTONES-->
					<div class="form-group">
					<label class="col-sm-4 control-label" for=""></label>	    
						<div class="col-sm-6">
							<button type="submit" id="btnSubmit" name="enviar" class="btn btn-success btn-md" value="Aceptar"><span class="glyphicon glyphicon glyphicon-ok-circle"></span> Aceptar</button>	
							<button type="reset" onclick="location.href='indexAdmin.php?list=current'" id="btnButton" name="cancelar" class="btn btn-danger btn-md" value="Cancelar"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
						</div>
					</div><br/>
				</form>
		   </div>
        </div>
<?php } ?>
	<?php
        include_once (__DIR__."/templates/footer.php");
    ?>

        <script src="lib/jquery-ui/external/jquery/jquery.js"></script>
        <script src="lib/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>