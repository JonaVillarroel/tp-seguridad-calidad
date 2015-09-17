
<div class="modal fade" id="modalPrivateMessages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" >
                    <?php echo "$nombreMuro $apellidoMuro"; ?>
                </h4>
                <input type="hidden" id="recipientUser" value="<?php echo $_GET['usuario'];?>"/>
            </div>
            <div class="modal-body">
                <form>
                    <div class="message-area" >
                        <ul class="list-group" id="message-reload">

                            <?php
                                require_once (dirname(__DIR__)."/php/views/inboxChat.php");

                            ?>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Mensaje:</label>
                        <textarea class="form-control" id="message-content"></textarea>
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