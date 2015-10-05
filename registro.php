<?php
    require './php/domain/Session.php';
    require_once("securimage/securimage.php");

    
    $mysession = new Session();
    $mysession->initSession();


    $nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : false;
    $userLoggedId = isset($_SESSION['id']) ? $_SESSION['id'] : false;

	if($nombre){
		header ('location: index.php?error=5');
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
        <!--DIV FORMULARIO-->
		<div id="ContenedorFormulario">
		  <div id="ContenedorFormularioInterior">
			<div class="row">
				<div class="col-xs-12">
					<h1>Reg&iacute;strese</h1>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<span class="red">*Campos Obligatorios</span>
				</div>
			</div><br/>
				<form class="form-horizontal" method="post" autocomplete="off" onsubmit="return ValidarRegistroComun()" action="./php/controllers/signUpController.php">
					<!--NOMBRE-->
					<div class="form-group">
						<label class="col-sm-4 control-label" id="lblNombre" for="txtNombre">Nombre: <span class="red">*</span></label>
						<div class="col-sm-6 col-md-6">
							<input class="form-control" type="text" id="txtNombre"  name="name" onkeypress="return sololetras(event)" onpaste="return false" autocomplete="off"/>
							<div id="nonombreC" class="alert alert-danger">Por favor ingrese su Nombre</div>
							<div id="longnombreC" class="alert alert-danger">El Nombre debe tener menos de 50 caracteres</div>
							<div id="malnombreC" class="alert alert-danger">Por favor ingrese un Nombre v&aacute;lido</div>
						</div>
					</div>
					<!--APELLIDO-->
					<div class="form-group">
						<label class="col-sm-4 control-label" id="lblApellido" for="txtApellido">Apellido: <span class="red">*</span></label>
						<div class="col-sm-6 col-md-6">
							<input class="form-control" type="text" id="txtApellido"  name="surname" onkeypress="return sololetras(event)" onpaste="return false" autocomplete="off"/>
							<div id="noapelC" class="alert alert-danger">Por favor ingrese su Apellido</div>
							<div id="longapelC" class="alert alert-danger">El Apellido debe tener menos de 50 caracteres</div>
							<div id="malapelC" class="alert alert-danger">Por favor ingrese un Apellido v&aacute;lido</div>
						</div>
					</div>
					<!--NOMBRE DE USUARIO-->
					<div class="form-group">
						<label class="col-sm-4 control-label" id="lblNomUser" for="txtNomUser">Nombre de Usuario: <span class="red">*</span></label>
						<div class="col-sm-6 col-md-6">
							<input class="form-control" type="text" id="txtNomUser"  name="userName" onkeypress="return sololetras(event)" onpaste="return false" autocomplete="off"/>
							<div id="nonombreUC" class="alert alert-danger">Por favor ingrese Nombre de Usuario</div>
							<div id="longnombreUC" class="alert alert-danger">El Nombre de Usuario debe tener menos de 50 caracteres</div>
							<div id="malnombreUC" class="alert alert-danger">Por favor ingrese un Nombre de Usuario v&aacute;lido</div>
						</div>
					</div>
					<!--EMAIL-->
					<div class="form-group">
						<label class="col-sm-4 control-label marginright" id="lblEmail" for="txtEmail">Email: <span class="red">*</span></label>
						<div id="DivEmail" class="input-group col-md-6">
							<span class="input-group-addon">@</span>
							<input class="form-control" type="text" id="txtEmail" name="mail" autocomplete="off"/>
							<div id="noemailC" class="alert alert-danger">Por favor ingrese su EMail</div>
							<div id="longemailC" class="alert alert-danger">El EMail debe tener menos de 50 caracteres</div>
							<div id="malemailC" class="alert alert-danger">Por favor ingrese un EMail v&aacute;lido</div>
						</div>
					</div>
					<!--CONTRASEÑA-->
					<div class="form-group">
						<label class="col-sm-4 control-label" id="lblContrasena" for="pswContrasena">Contrase&#xf1;a: <span class="red">*</span></label>
						<div class="col-sm-6">
							<input class="form-control" type="password" id="pswContrasena" name="pass" autocomplete="off"/>
							<span class="help-block">La contrase&ntilde;a debe tener como m&iacute;nimo 6 caracteres.</span>
							<div id="nopswC" class="alert alert-danger">Por favor ingrese su Contrase&#xf1;a</div>
							<div id="longpswC" class="alert alert-danger">La Contrase&#xf1;a debe tener menos de 50 caracteres</div>
							<div id="malpswC" class="alert alert-danger">Por favor ingrese un Contrase&#xf1;a v&aacute;lida</div>
							<div id="minpswC" class="alert alert-danger">La Contrase&#xf1;a debe tener un m&iacute;nimo de 6 caracteres</div>
						</div>
					</div>
					<!--VERIFICACION DE CONTRASEÑA-->
					<div class="form-group">
						<label class="col-sm-4 control-label" id="lblVeriContrasena" for="pswVeriContrasena">Repetir Contrase&#xf1;a: <span class="red">*</span></label>
						<div class="col-sm-6">
							<input class="form-control" type="password" id="pswVeriContrasena" name="repass" autocomplete="off"/>
							<div id="nopsw2C" class="alert alert-danger">Por favor repita su Contrase&#xf1;a</div>
							<div id="malpsw2C" class="alert alert-danger">Las Contrase&#xf1;as no coinciden</div>
						</div>
					</div><br/>
					

					<div class="form-group robotic ">
						<label class="col-sm-4 control-label " id="" for="">Email:</label>
						<div class="col-sm-6">
						<input class="form-control " type="text" id="emailf" name="emailf" autocomplete="off"/>
						</div>
						
					</div>


					<div class="form-group robotic2">
						<label class="col-sm-4 control-label " id="" for="">Nombre:</label>
						<div class="col-sm-6">
						<input class="form-control" type="text" id="" name="namef" autocomplete="off"/>
						</div>
						
					</div>
					
					<div class="form-group">

						<label class="col-sm-4 control-label" id="lblVeriCaptcha" for="">Captcha <span class="red">*</span></label>

							<div class="col-sm-6 col-md-6">
								<input class="form-control" id="captchaId" type="text" name="captcha_code" size="10" maxlength="6" autocomplete="off" />
									<div id="emptyCaptcha" class="alert alert-danger">Completá el captcha.</div>
									<br>
									<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />

									<img id="otherCaptcha" alt="refresh-captcha" src="securimage/images/refresh.png" alt="">
							</div>
					</div>


					<!--BOTONES-->
					<div class="form-group">
					<label class="col-sm-4 control-label" for=""></label>
						<div class="col-sm-6">
							<button type="submit" id="btnSubmit" name="enviar" class="btn btn-success btn-md" value="Aceptar"><span class="glyphicon glyphicon glyphicon-ok-circle"></span> Aceptar</button>
							<button type="reset" id="btnButton" name="cancelar" class="btn btn-danger btn-md" value="Cancelar"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
						</div>
					</div><br/>

				</form>
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