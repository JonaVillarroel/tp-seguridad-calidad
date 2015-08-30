<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TheWall</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<link rel="stylesheet" type="text/css" href="lib/bootstrap.min.css"></link>
	<link rel="stylesheet" type="text/css" href="lib/mybootstrap.css"></link>
	<link rel="stylesheet" href="bootstrap/css/bootstrapLimpio.min.css">
	<link rel="stylesheet" href="css/main.css">
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
		  <div class="col-md-10"><textarea class="form-control" id="feedbox" rows="3" placeholder="Publica un mensaje!"></textarea><br>
		  <button type="button" id="button" class="btn btn-default">Publicar</button>
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



	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/main.js"></script>
	<script src="bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>