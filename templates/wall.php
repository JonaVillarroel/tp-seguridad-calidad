<div id="wall" class="col-sm-12">
    <?php
        include_once (dirname(__DIR__)."/php/controllers/getWallCtrl.php");
        if(!($privacidad == 'privado') || ($privacidad == 'privado' && $userAllow) || $_GET['usuario'] == $UserLoggedId){
    ?>
        <h2><?php echo "$nombre $apellido (Wall)"?></h2>
        <div class="col-sm-12">

            <div class="col-sm-10 col-sm-push-1">
                <form class="form-horizontal" method="post" action="./php/controllers/postMessageCtrl.php">
                <div class="col-sm-10 col-sm-push-1 btn-message" id="newMessage" name="newMessage">
                    <textarea type="text" name="content" class="form-control" maxlength="280" rows="5"></textarea><br/>
                    <input name="fromUser" value="<?php echo $idUser?>" type="hidden"/>
					<input name="toUser" value="<?php echo $id?>" type="hidden"/>
                    <button type="submit" id="btnMessage" name="btnMessage" class="btn btn-success btn-md pull-right">
                        <span class="glyphicon glyphicon-send"></span> Publicar
                    </button>
                </div>
                </form>

                <div class="btn-message col-sm-10 wall">
                    <?php
                        foreach($mensajes as $contenido){                                
                    ?>
                    <hr class="col-sm-10 col-sm-push-1">
                            <div id="toRepeat" name="toRepeat">
                                <div class="col-sm-2">
                                    <div class="pull-right">
                                        <img src="img/user.png" alt="usuario" class="img-circle">
                                    </div>
                                </div>
                                <div class="col-sm-10 mensaje">
                                    <?php echo $contenido; ?>    
                                </div>
                            </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <?php }else{
        $error = 'El muro que desea ingresar es privado.';
    ?>
    <div class="alert alert-danger text-center col-sm-8 col-sm-push-2" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?php echo $error; ?>
    </div>
    <?php } ?>
</div>