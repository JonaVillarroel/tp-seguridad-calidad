<!-- Modal SignUp-->
<div id="myModalSignUp" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="conteinerCentrado panel-body">
                <div class="container-fluid col-sm-4">
				<form class="form-horizontal" method="post" action="../php/controllers/signUpController.php">
                    <h3>Regístrese</h3>
                    <div class="form-group">
                        <label for="focusedInput">Nombre</label>
                        <input class="form-control" name="name" id="focusedInput" type="text">
                        <label for="focusedInput">Apellido</label>
                        <input class="form-control" name="surname" id="focusedInput" type="text">
                        <label for="focusedInput">Nombre de Usuario</label>
                        <input class="form-control" name="userName" id="focusedInput" type="text">
                        <label for="focusedInput">Correo electrónico</label>
                        <input class="form-control" name="mail" id="focusedInput" type="text">
                        <label for="focusedInput">Contraseña</label>
                        <input class="form-control" name="pass" id="focusedInput" type="password">
                        <label for="focusedInput">Confirme la contraseña</label>
                        <input class="form-control" name="repass" id="focusedInput" type="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary active">Registrarse</button>
                    </div>
				</form>
                </div>
            </div>
        </div>

    </div>
</div>