<?php
	//EVITO LOS WARNINGS DE VARIABLES NO DEFINIDAS
	$list = isset($_GET['list']) ? $_GET['list'] : null;
	require './php/domain/Session.php';
	$mysession = new Session();
	$mysession->initSession();
	
	$username = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null;
	$usersurname = isset($_SESSION['apellido']) ? $_SESSION['apellido'] : null;
	$userLoggedId = isset($_SESSION['id']) ? $_SESSION['id'] : false;
	
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
    <title>The Wall</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="icon" type="image/png" href="img/muroBlanco.png">
</head>

<body>
	<?php
        include_once (__DIR__."/templates/header.php");
    ?>

<div class="col-sm-1 pull-right">
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<li class="dropdown"><h1><span class='glyphicon glyphicon-wrench'></span></h1></li>
		<hr>
	    <div>

	      <ul class="nav navbar-nav navbar-right">
	        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class='glyphicon glyphicon-envelope'></span><span class="caret"></span></a>
	          <ul class="dropdown-menu dropdown-menu-right">
			      <li><a class="btn" data-toggle="modal" data-target="#modalMsjPriv">Bandeja de Entrada</a></li>
			      <li><a class="btn" data-toggle="modal" data-target="#modalMsjPub">Publicac. al Muro</a></li>
		    </ul>
	        </li>
	        <li><a href="#">---</a></li>
	        <li><a href="#">---</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
</div>

<div class="container bg">
	<div class="row">		
        <div class="col-sm-12">			 
            <div class="menuvertical list-group col-sm-12">
				<?php
					switch($list){			
						case 'request':
							echo "<a href='indexAdmin.php?list=request' class='list-group-item col-sm-4 active'><span class='icon-user'></span> Solicitudes</a>";
							echo "<a href='indexAdmin.php?list=current' class='list-group-item col-sm-4'><span class='icon-users'></span> Usuarios Del Sisterma</a>";
							echo "<a href='indexAdmin.php?list=formerusers' class='list-group-item col-sm-4'><span class='icon-user-tie'></span> Usuarios Dados de Baja</a>";
						break;
						case 'current':
							echo "<a href='indexAdmin.php?list=request' class='list-group-item col-sm-4'><span class='icon-user'></span> Solicitudes</a>";
							echo "<a href='indexAdmin.php?list=current' class='list-group-item col-sm-4 active'><span class='icon-users'></span> Usuarios Del Sisterma</a>";
							echo "<a href='indexAdmin.php?list=formerusers' class='list-group-item col-sm-4'><span class='icon-user-tie'></span> Usuarios Dados de Baja</a>";
						break;
						case 'formerusers':
							echo "<a href='indexAdmin.php?list=request' class='list-group-item col-sm-4'><span class='icon-user'></span> Solicitudes</a>";
							echo "<a href='indexAdmin.php?list=current' class='list-group-item col-sm-4'><span class='icon-users'></span> Usuarios Del Sisterma</a>";
							echo "<a href='indexAdmin.php?list=formerusers' class='list-group-item col-sm-4 active'><span class='icon-user-tie'></span> Usuarios Dados de Baja</a>";
						break;
						default:
							echo "<a href='indexAdmin.php?list=request' class='list-group-item col-sm-4 active'><span class='icon-user'></span> Solicitudes</a>";
							echo "<a href='indexAdmin.php?list=current' class='list-group-item col-sm-4'><span class='icon-users'></span> Usuarios Del Sisterma</a>";
							echo "<a href='indexAdmin.php?list=formerusers' class='list-group-item col-sm-4'><span class='icon-user-tie'></span> Usuarios Dados de Baja</a>";
						break;
					}
				?>
            </div>
        </div>
			
		<div class="col-md-12">
			
	<?php
		/*--///////////////////////////////////////////////////---------SOLICITUDES--------//////////////////////////////////////////////////--*/
		if($list == 'request' or $list == ''){
	?>
			<table class="table table-bordered table-hover">
				<thead>
					<tr class="warning">
						<th>#</th>
						<th>Rol</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Mail</th>
						<th>Nombre de Usuario</th>
						<th>Estado</th>
						<th class="center">Dar de Alta</th>
					</tr>
				</thead>
			<?php
				require "./php/domain/User.php";
				$user = new User();
				$result = $user -> getUsersStatusPending();
		
			while($row = $result -> fetch_object()) {
			?>
				<tbody>
					<tr>
						<td><?php echo $row->id_usuario ?></td>
						<td><?php echo $row->rol ?></td>
						<td><?php echo $row->nombre ?></td>
						<td><?php echo $row->apellido ?></td>
						<td><?php echo $row->mail ?></td>
						<td><?php echo $row->nombre_usuario ?></td>
						<td><span class="red"><?php echo $row->estado ?></span></td>
						<td><p class="center"><a class="btn btn-success btn-sm" href="./php/controllers/approveUserControllers.php?id=<?php echo $row->id_usuario?>" role="button"><span class="glyphicon glyphicon-ok"></span></a></p></td>
					</tr>
				</tbody>
			<?php } ?>
			</table>
		</div>
	<?php } ?>
	
	<?php
		/*--///////////////////////////////////////////////////---------USUARIOS DEL SISTEMA--------//////////////////////////////////////////////////--*/
		if($list == 'current'){
	?>
			<table class="table table-bordered table-hover">
				<thead>
					<tr class="warning">
						<th>#</th>
						<th>Rol</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Mail</th>
						<th>Nombre de Usuario</th>
						<th>Estado</th>
						<th class="center">Editar / Dar de Baja</th>
					</tr>
				</thead>
			<?php
				require "./php/domain/User.php";
				$user = new User();
				$result = $user -> getUsersStatusCurrent();

			while($row = $result -> fetch_object()) {
				if($row->id_usuario == 1 or $row->rol == 'Administrador'){}else{
			?>
				<tbody>
					<tr>
						<td><?php echo $row->id_usuario ?></td>
						<td><?php echo $row->rol ?></td>
						<td><?php echo $row->nombre ?></td>
						<td><?php echo $row->apellido ?></td>
						<td><?php echo $row->mail ?></td>
						<td><?php echo $row->nombre_usuario ?></td>
						<td><span class="green"><?php echo $row->estado ?></span></td>
						<td><p class="center">
								<a class="btn btn-primary btn-sm" href="./editUser.php?id=<?php echo $row->id_usuario?>" role="button">
									<span class="glyphicon glyphicon-pencil"></span>
								</a> / 
								<a class="btn btn-danger btn-sm" href="./php/controllers/disapproveUserControllers.php?id=<?php echo $row->id_usuario?>" role="button">
									<span class="glyphicon glyphicon-remove"></span>
								</a>								
							</p>
						</td>
					</tr>
				</tbody>
			<?php }
			}?>
			</table>
		</div>
	<?php } ?>
	
	<?php
		/*--///////////////////////////////////////////////////---------USUARIOS DADOS DE BAJA--------//////////////////////////////////////////////////--*/
		if($list == 'formerusers'){
	?>
			<table class="table table-bordered table-hover">
				<thead>
					<tr class="warning">
						<th>#</th>
						<th>Rol</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Mail</th>
						<th>Nombre de Usuario</th>
						<th>Estado</th>
					</tr>
				</thead>
			<?php
				require "./php/domain/User.php";
				$user = new User();
				$result = $user -> getUsersStatusDisapprove();
		
			while($row = $result -> fetch_object()) {
			?>
				<tbody>
					<tr>
						<td><?php echo $row->id_usuario ?></td>
						<td><?php echo $row->rol ?></td>
						<td><?php echo $row->nombre ?></td>
						<td><?php echo $row->apellido ?></td>
						<td><?php echo $row->mail ?></td>
						<td><?php echo $row->nombre_usuario ?></td>
						<td><span class="red">DADO DE BAJA</span></td>
					</tr>
				</tbody>
			<?php } ?>
			</table>
		</div>
	<?php } ?>
	
	</div>
</div>
<?php
    include_once (__DIR__."/templates/footer.php");
?>

	<?php

	if(isset($_SESSION['id']))
	{
		require_once (__DIR__."/templates/modalInbox.php");
		require_once (__DIR__."/templates/modalPrivateMessagesInbox.php");
	};

	?>

	<?php

	if(isset($_SESSION['id']))
	{
		require_once (__DIR__."/templates/modalInbox.php");
		require_once (__DIR__."/templates/modalPrivateMessagesInbox.php");
	};

	?>

	  <!-- Modal -->
	<div class="modal fade" id="modalMsjPriv" role="dialog">
		<div class="modal-dialog modal-sm">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header" style="padding:35px 50px;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4><span class="glyphicon glyphicon-wrench"></span> Configuración de mensajes privado</h4>
				</div>
				<div class="modal-body" style="padding:40px 50px;">
					<form method="post" role="form form-inline" action="./php/controllers/modifyAdminControllers.php?id=<?php echo $userLoggedId?>">
						<div class="form-group">
							<label for="numMsjPrivLimit"><span class="glyphicon glyphicon-envelope"></span> Límite: </label>
							<div class="input-group">
								<input type="number" min="0" class="form-control" name="MsjPrivLimit" id="numMsjPrivLimit" placeholder="20">
								<input type="hidden" class="form-control" name="Id" id="hidId" value="<?php echo $userLoggedId?>">
								<span class="input-group-addon"><button type="submit" id="btnSubmitPrivLimit" class="btn btn-success btn-md" role="button"></button></span>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				</div>
			</div>
		</div>
	</div>

	  <!-- Modal Configuracion Limite Muro -->
	<div class="modal fade" id="modalMsjPub" role="dialog">
		<div class="modal-dialog modal-sm">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header" style="padding:35px 50px;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4><span class="glyphicon glyphicon-wrench"></span> Configuración de mensajes públicos</h4>
				</div>
				<div class="modal-body" style="padding:40px 50px;">
					<form method="post" role="form form-inline">
						<div class="form-group">
							<label for="numMsjPrivLimit"><span class="glyphicon glyphicon-envelope"></span> Privados</label>
							<div class="input-group">
								<input type="number" class="form-control" name="MsjPrivLimit" id="numMsjPrivLimit" placeholder="20">
								<input type="hidden" class="form-control" name="Id" id="hidId" value="<?php echo $userLoggedId?>">
								<span class="input-group-addon"><button type="submit" id="btnSubmitPrivLimit" class="btn btn-success btn-md" role="button"></button></span>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				</div>
			</div>
		</div>
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

	<script src="lib/jquery-ui/external/jquery/jquery.js"></script>
	<script src="lib/jquery-ui/jquery-ui.min.js"></script>
	<script src="lib/bootstrap/js/bootstrap.js"></script>
	<script src="js/main.js"></script>
</body>
</html>