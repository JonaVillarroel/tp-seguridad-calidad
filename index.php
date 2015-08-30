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

    <div class="row">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="#menu">
                <span class="glyphicon glyphicon-menu-hamburger"></span>
            </button>
            <a href="index.php" class="navbar-brand">The Wall</a>
        </div>

        <div class="collapse navbar-collapse col-md-12 pull-right" id="menu">

            <ul class="nav navbar-nav">

                <li><a href="user.php">Laura Gutierrez</a></li>
                <li><a href="#">Configuración</a></li>
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalLogin">Entrar</button>
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalSignUp">Registrarse</button>
            </ul>
        </div>
    </div>


    <h4>Muro general</h4>
    <div class="row publication">
        <div class="col-md-2"><img src="http://packetcode.com/apps/wall-design/image.jpg" class="img-circle" width="40%"/></div>
        <div class="col-md-10"><textarea class="form-control" id="feedbox" rows="3" placeholder="Publica un mensaje!"></textarea><br>
            <button type="button" id="button" class="btn btn-default">Publicar</button>
        </div>
    </div>

    <div class="row publication" >
        <div class="col-md-2"><img src="http://7-themes.com/data_images/out/60/6976065-dark-colors-abstract.jpg" class="img-circle" width="40%"/></div>
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

                <div>Primera publicación</div>
                <div class="text-muted"> <small>Hace 3 horas</small></div>
            </div>
        </div>
    </div>

    <div class="row">

        <footer>
            <div class="col-xs-12 bg-info">
                <h5 class="text-info col-xs-offset-5   ">Universidad Nacional de la Matanza</h5>

            </div>
    </div>

    <div class="row">
        <div class="col-xs-12 bg-info">
            <p class="text-info text-right">Integrantes:</p>
            <p class="text-info text-right">García Matías</p>
            <p class="text-info text-right">León Manuel</p>
            <p class="text-info text-right">Magnoni Nicolás</p>
            <p class="text-info text-right">Ramírez Federico</p>
            <p class="text-info text-right">Villarroel Jonatan</p>
        </div>
    </div>
    </footer>

</div>

<!-- Modal Login-->
<div id="myModalLogin" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <!--    <img id="muro" src="img/muroBlanco.jpg">
-->
            <div class="container-fluid alert alert-info">
                <div class="marginAuto form-group form-inline">
                    <label for="focusedInput">Usuario</label>
                    <input class="form-control" id="focusedInput" type="text">
                    <label for="focusedInput">Contraseña</label>
                    <input class="form-control" id="focusedInput" type="password">
                    <button type="button" class="btn btn-primary active">Iniciar Sesión</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal SignUp-->
<div id="myModalSignUp" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="conteinerCentrado panel-body">
                <div class="container-fluid col-sm-4">
                    <h3>Regístrese</h3>
                    <div class="form-group">
                        <label for="focusedInput">Nombre</label>
                        <input class="form-control" id="focusedInput" type="text">
                        <label for="focusedInput">Apellido</label>
                        <input class="form-control" id="focusedInput" type="text">
                        <label for="focusedInput">Nombre de Usuario</label>
                        <input class="form-control" id="focusedInput" type="text">
                        <label for="focusedInput">Correo electrónico</label>
                        <input class="form-control" id="focusedInput" type="text">
                        <label for="focusedInput">Contraseña</label>
                        <input class="form-control" id="focusedInput" type="password">
                        <label for="focusedInput">Confirme la contraseña</label>
                        <input class="form-control" id="focusedInput" type="password">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary active">Registrarse</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/main.js"></script>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>