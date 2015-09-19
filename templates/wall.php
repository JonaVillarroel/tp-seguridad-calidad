<div id="wall" class="col-sm-12">
    <?php
        require_once (dirname(__DIR__)."/php/controllers/getWallCtrl.php");
    ?>
        <h2><?php echo "$nombreMuro $apellidoMuro"?></h2>
        <div class="col-sm-12">

            <div class="col-sm-1">
                <div class="avatar-wall">
                    <img class="img-circle" src="http://lorempixel.com/200/200" alt=""/>
                </div>
                <?php

                if($userLoggedId != false && $userLoggedId != $_GET['usuario']){
                    echo "<a class='btn btn-default btn-lg' href='#' id='privateMessageModalBtn'><span class='glyphicon glyphicon-envelope'></span> Mensaje Privado</a>";
                };
                ?>
            </div>
            <div class="col-sm-10 col-sm-push-1">
                <?php
                if(!($privacidad == 'privado') || ($privacidad == 'privado' && $userAllow) || $_GET['usuario'] == $userLoggedId ){
                    ?>
                <form class="form-horizontal" method="post" action="./php/controllers/postMessageCtrl.php">
                    <div class="col-sm-10 col-sm-push-1 btn-message" id="newMessage" name="newMessage">

                        <h4>Mensaje público <small>(<span id="countdownWall" class="visible-*-inline-block">200 caracteres disponibles</span>)</small>:</h4>
                            <div id="divmessageWall" class="has-success has-feedback">
                                <textarea id="messageWall-content" type="text" class="form-control" maxlength="200" rows="5" placeholder='Escribí tu mensaje...'></textarea><br/>
                            </div>

                       
                        <input name="toWall" value="<?php echo $idMuro?>" type="hidden"/>
                        <input name="toUser " value="<?php echo $_GET['usuario']?>" type="hidden"/>
                        <button type="submit" id="btnMessage" name="btnMessage" class="btn btn-success btn-md pull-right">
                            <span class="glyphicon glyphicon-send"></span> Publicar
                        </button>
                    </div>
                </form>
                <div class="btn-message col-sm-10 wall">
                    <?php
                        if(isset($rows)) {
                            foreach ($rows as $fila) {
                                ?>
                                <hr class="col-sm-12 icon-image">
                                <div id="toRepeat" name="toRepeat">
                                    <div class="col-sm-3">
                                        <div class="text-center">
                                            <img src="img/user.png" alt="usuario" class="img-circle icon-image"><br/>
                                            <?php echo "<span>$fila->nombre <br/> $fila->apellido</span>" ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-9 mensaje">
                                        <?php echo $fila->contenido ?>
                                    </div>
                                </div>
                            <?php }

                        };
                    ?>
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

        </div>


</div>