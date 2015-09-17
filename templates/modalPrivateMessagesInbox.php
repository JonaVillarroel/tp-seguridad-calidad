
<div class="modal fade" id="modalPrivateMessagesInbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" >
                </h4>
                <input type="hidden" id="toUserInbox" value=""/>
            </div>
            <div class="modal-body">
                <form>
                    <div class="message-area" id="message-area-inbox" >
                        <ul class="list-group" id="messageFromInbox-reload">

<!--                            --><?php
/*                            require_once (dirname(__DIR__)."/php/views/inboxChat.php?usuarioRemitent=");

                            */?>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Mensaje:</label>
                        <textarea class="form-control" id="message-content-fromInbox"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="sendMessageFromInboxBtn" >Enviar</button>
            </div>
        </div>
    </div>
</div>