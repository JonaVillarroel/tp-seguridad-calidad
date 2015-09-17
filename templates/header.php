<?php
	//EVITO LOS WARNINGS DE VARIABLES NO DEFINIDAS
	$error = isset($_GET['error']) ? $_GET['error'] : null;
?>
<div id="header">
    <div class="navbar navbar-default">
	<?php
		$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : null;
		if($rol == 'Comun' or $rol == null){
			echo "<a href='index.php' class='navbar-brand'>The Wall</a>";
		}
		if($rol == 'Administrador'){
			echo "<a href='indexAdmin.php' class='navbar-brand'>The Wall</a>";
		}
	?>
        
        <div class="pull-right">
            <?php
                if(!$userLoggedId){
            ?>
            <form class="navbar-form navbar-left" method="post" action="php/controllers/loginController.php">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="E-mail" id="mail" name="mail">
                    <input type="password" class="form-control" placeholder="Contraseña" id="pass" name="pass">
                </div>
                <button type="submit" class="btn btn-default">Ingresar</button>
            </form>

            <p class="navbar-text"><a href="./registro.php" class="navbar-link">Registrarse</a></p>
             
            <?php
            }else{
            ?>           
            <p class="navbar-text">
				<a class="navbar-link" href="#" id="inboxModalBtn"><span class="glyphicon glyphicon-envelope"></span></a> |
				<a class="navbar-link" href="userConfiguration.php"><span class="glyphicon glyphicon-cog"></span></a> |
                <a class="navbar-link" href="index.php?usuario=<?php echo $_SESSION['id']; ?>"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></a> |
                <a class="navbar-link" href="php/controllers/exitController.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
            </p>
            <?php
            }
            ?>
			
			<?php
				if($error == 1){
					echo "<div class='alert alert-danger'>";
						echo "Mail o Contrase&ntilde;a incorrectos <br/>";
					echo "</div>";
				}
				if($error == 2){
					echo "<div class='alert alert-danger'>";
						echo "Debe iniciar sesion para poder acceder al sitio <br/>";
					echo "</div>";
				}
				if($error == 3){
					echo "<div class='alert alert-danger'>";
						echo "Necesita iniciar Sesion como Administrador para acceder al sitio <br/>";
					echo "</div>";
				}
				if($error == 4){
					echo "<div class='alert alert-danger'>";
					echo "Te pasas de listo pillin <br/>";
					echo "</div>";
				}
			?>
			
        </div>
    </div>
</div>

<?php
	require_once (__DIR__."/modalInbox.php");
	require_once (__DIR__."/modalPrivateMessagesInbox.php");
?>



