
<div class="modal fade" id="modalPrivateMessages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" >
                    <?php echo "$nombreMuro $apellidoMuro"; ?>
                </h4>
                <input type="hidden" id="userRecipient" value="<?php echo $_GET['usuario'];?>"/>
            </div>
            <div class="modal-body">
                <form>
                    <div class="message-area" id="message-area-private">
                        <ul class="list-group" id="message-reload">

                        </ul>
                    </div>
                    <label for="message-text" class="control-label" >Mensaje:</label><small>(<span id='countdownPrivate' class='visible-*-inline-block'>200 caracteres disponibles</span>)</small>
                    <div id='divmessagePrivate' class="form-group has-success">
                        <textarea class="form-control" id="message-content" maxlength='200'></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="sendMessageBtn" >Enviar</button>
            </div>
        </div>
    </div>
</div>  