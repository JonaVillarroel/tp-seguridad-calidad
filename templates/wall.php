<div id="wall" class="col-sm-12">
    <h2>Mi Wall</h2>

        <?php
            include_once (dirname(__DIR__)."/php/controllers/getWallCtrl.php");
        ?>

        <div class="col-sm-12">

            <div class="col-sm-10 col-sm-push-1">

                <div class="col-sm-10 col-sm-push-1 btn-message" id="newMessage" name="newMessage">
                    <textarea type="text" class="form-control" maxlength="280" rows="5"></textarea><br/>
                    <button type="submit" id="btnMessage" name="btnMessage" class="btn btn-success btn-md pull-right">
                        <span class="glyphicon glyphicon-send"></span> Publicar
                    </button>    
                </div>

                <div class="btn-message col-sm-10 wall">
                    <?php
                        while($obj = $muro -> fetch_object()){
                            $contenido = $obj -> contenido;
                            if($contenido)
                                
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
                    <?php 
                        } 
                    ?>
                </div>
            </div>

        </div>
</div>