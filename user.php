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
	<title>The Wall</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<link rel="icon" type="image/png" href="img/muroBlanco.png">

<title>The Wall</title>
</head>
<body>
	<div class="container-fluid">

	<?php
	include_once (__DIR__."/templates/header.php");
	?>

    <div class="row" style="background:url('http://img14.deviantart.net/95e7/i/2014/007/d/3/google_abstract_by_dynamicz34-d718hzj.png')">
		
		 <div class="col-md-3">
		 	<img src="http://packetcode.com/apps/wall-design/image.jpg" class="img-circle"/>
		 </div>
		
		<div class="col-md-9">
			<div class=""><h4><a class="user-name" href="#">Laura Gutierrez</a></h4></div>
		</div>

   	</div>

     <h4>Muro de <a href="#">Laura Gutierrez</a></h4>

    <div class="row publication">
		  <div class="col-md-2"><img src="http://packetcode.com/apps/wall-design/image.jpg" class="img-circle" width="40%"/></div>
		  <div class="col-md-10"><textarea class="form-control" id="message" rows="3" placeholder="Publica un mensaje!"></textarea><br>
		  <button type="button" id="postMessageBtn" class="btn btn-default">Publicar</button>
		  </div>
	</div>

	


	<div class="row publication">
		  <div class="col-md-2"><img src="http://7-themes.com/data_images/out/60/6976065-dark-colors-abstract.jpg" class="img-circle" width="40%"/>
		  </div>
		  <div class="col-md-10">
		  	<div><b>Lucas Rodríguez </b>
		
		  	<div>Hola Laura!</div>
		  	<div class="text-muted"> <small>Hace 1 hora</small></div>
		  </div>
		</div>
	</div>

		<div class="row publication">
		  <div class="col-md-2"><img src="http://packetcode.com/apps/wall-design/image.jpg" class="img-circle" width="40%"/></div>
			  <div class="col-md-10">
				 <div><b>Laura Gutierrez </b>

					<div>Primera publicación
					</div>
					 <div class="text-muted"> <small>Hace 3 horas</small>
					</div>
				</div>
			</div>
		</div>

		<?php
		include_once (__DIR__."/templates/footer.php");
		?>
	</div>

	<?php
	include_once (__DIR__."/templates/modalLogin.php");
	?>

	<?php
	include_once (__DIR__."/templates/modalSignUp.php");
	?>



	<script src="lib/jquery-ui/external/jquery/jquery.js"></script>
	<script src="lib/jquery-ui/jquery-ui.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/postMessage.js"></script>

</body>
</html>