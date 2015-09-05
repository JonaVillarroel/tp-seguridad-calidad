<div id="header">
    <div class="navbar navbar-default">
        <a href="index.php" class="navbar-brand">The Wall</a>
        <div class="pull-right">
            <?php
                if($username){
            ?>
            <form class="navbar-form navbar-left" method="post" action="#">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="E-mail" id="mail">
                    <input type="password" class="form-control" placeholder="Contraseña" id="pass">
                </div>
                <button type="submit" class="btn btn-default">Ingresar</button>
            </form>

            <p class="navbar-text"><a href="./registro.php" class="navbar-link">Registrarse</a></p>
             
            <?php
            }else{
            ?>           
            <p class="navbar-text">
                <a class="navbar-link" href="#"><span class="glyphicon glyphicon-cog"></span></a> |
                <a class="navbar-link" href="user.php"><span class="glyphicon glyphicon-user"></span> Usuario</a> |
                <a class="navbar-link" href="user.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
            </p>
            <?php
            }
            ?>
        </div>
    </div>
</div>

