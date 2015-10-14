    <div class="modal fade" id="modalPrivateMessages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >
                        <?php echo "$nombreMuro $apellidoMuro"; ?>
                    </h4>
                    <?php echo "Bandeja: $IdBandeja | $totalPrivateMsg de $limitPrivateMsg"; ?>
                    <input type="hidden" id="userRecipient" value="<?php echo $_GET['usuario'];?>"/>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="message-area" id="message-area-private">
                            <ul class="list-group" id="message-reload">

                            </ul>
                        </div>
                        <input type="hidden" id="inpLimitPrivateMsg" name="inpLimitPrivateMsg" value="<?php echo $limitPrivateMsg; ?>">
                        <?php
                            if ($totalPrivateMsg < $limitPrivateMsg) {
                                echo "  <label for='message-text' class='control-label' >Mensaje privado </label><small><span id='countdownPrivate' class='visible-*-inline-block'>(200 caracteres disponibles)</span></small>:
                                        <div id='divmessagePrivate' class=' has-success'>
                                            <textarea id='message-content' class='form-control' name='content' type='text' maxlength='200' placeholder='Escribí tu mensaje...'></textarea>
                                        </div>";
                            } else {
                                echo "  <label for='message-text' class='control-label' >Mensaje privado </label> <small class='alert-danger'><span>( La casilla se encuentra llena )</span></small>
                                        <textarea type='text' class='form-control' maxlength='0' disabled placeholder='No se puede ingresar texto...'></textarea><br/>";
                            }
                        ?> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <?php
                        if ($totalPrivateMsg < $limitPrivateMsg) {
                            echo "<button type='button' class='btn btn-primary' id='sendMessageBtn' >Enviar</button>";
                        } else{
                            echo "<button type='button' class='btn btn-primary' disabled>Enviar</button>";
                        }
                    ?> 
                </div>
            </div>
        </div>
    </div>  