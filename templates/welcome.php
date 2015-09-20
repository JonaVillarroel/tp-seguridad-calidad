<div class="col-sm-12">
	<div class="jumbotron col-sm-6 col-sm-push-3">
		<h1 class="text-center">The Wall</h1>
		<p>The Wall te ayuda a comunicarte y compartir con las personas que forman parte de tu vida.</p>
		<?php
		if(!$userLoggedId) {
			?>
			<p><a class="btn btn-primary btn-lg pull-right" href="./registro.php" role="button">Registrarse</a></p>
			<?php
		}
		?>
	</div>
</div>