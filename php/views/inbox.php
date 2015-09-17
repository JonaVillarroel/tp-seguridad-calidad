<?php
require_once (dirname(__DIR__)."/services/InboxRepositoryService.php");
require_once (dirname(__DIR__)."/domain/Session.php");

$mysession = new Session();
$mysession->initSession();

$inboxRepo = new InboxRepositoryService();

$userId = $_SESSION['id'];

$conversations = $inboxRepo -> getConversationsByUserId($userId);

$cont = 0;
while($conversation = $conversations -> fetch_object())
{
    $cont++;

    if($conversation -> id_usuario == $userId )
    {
        echo "<li class='list-group-item conversation-item'>
                    <input type='hidden' class='propIdBandeja' value='".$conversation->prop_id_bandeja."'/>
                    <input type='hidden' class='propNombreBandeja' value='".$conversation->prop_nombre_bandeja."'/>
                    <input type='hidden' class='propApellidoBandeja' value='".$conversation->prop_apellido_bandeja."'/>
                    <div class='conversation-item'>
                        <div class='avatar'>
                            <img class='img-circle' src='http://lorempixel.com/200/200/people/".$cont."' alt=''/>
                        </div>
                        <div class='userName'>
                            <p>".$conversation->prop_nombre_bandeja." ".$conversation->prop_apellido_bandeja."</p>
                        </div>
                        <div class='message-review'>
                            <p><span><i class='glyphicon glyphicon-triangle-left'></i></span>". $conversation->contenido."</p>
                        </div>
                        <div class='message-date'>
                            <p>".$conversation->fecha_alta."</p>
                        </div>
                    </div>
                </li>";
    }else{
        echo "<li class='list-group-item conversation-item'>
                    <div class='conversation-item'>
                        <div class='avatar'>
                            <img class='img-circle' src='http://lorempixel.com/200/200/people' alt=''/>
                        </div>
                        <div class='userName'>
                            <p>".$conversation->prop_nombre_bandeja." ".$conversation->prop_apellido_bandeja."</p>
                        </div>
                        <div class='message-review'>
                            <p>".$conversation->contenido."</p>
                        </div>
                        <div class='message-date'>
                            <p>".$conversation->fecha_alta."</p>
                        </div>
                    </div>
                </li>";
    }
}
?>
