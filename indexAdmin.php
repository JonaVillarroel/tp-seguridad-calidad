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