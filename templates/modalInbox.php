<div class="modal fade" id="modalInbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-inbox">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Bandeja de Entrada</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="conversations-area">
                        <ul class="list-group">

                            <?php
                                require_once (dirname(__DIR__)."/php/views/inbox.php");
                            ?>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>