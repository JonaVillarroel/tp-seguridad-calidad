<?php
require_once (dirname(__DIR__)."/services/InboxRepositoryService.php");
require_once (dirname(__DIR__)."/domain/Session.php");

$mysession = new Session();
$mysession->initSession();


$inboxRepo = new InboxRepositoryService();

$userRemitentIdFirst = $_SESSION['id'];

$userRemitentIdSecond = $_GET['usuarioRemitent'];

$inboxIdFirst = $inboxRepo -> getInboxIdByUserId($userRemitentIdFirst);

$inboxIdSecond = $inboxRepo -> getInboxIdByUserId($userRemitentIdSecond);

$messages = $inboxRepo -> getMessagesOfChat($userRemitentIdFirst, $inboxIdFirst, $userRemitentIdSecond, $inboxIdSecond);

while($message = $messages -> fetch_object())
{
    if($message -> id_usuario == $userRemitentIdFirst )
    {
        echo "<li class='list-group-item text-right'>
        <div class='message-area-user'>
            <p>".$message->nombre." ".$message->apellido."</p>
        </div>
        <div class='message-area-content'>
            <p>".$message->contenido."</p>
        </div>
    </li>";
    }else{
        echo "<li class='list-group-item'>
        <div class='message-area-user'>
            <p>".$message->nombre." ".$message->apellido."</p>
        </div>
        <div class='message-area-content'>
            <p>".$message->contenido."</p>
        </div>
    </li>";
    }
}
?>
