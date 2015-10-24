<?php
require_once (dirname(__DIR__)."/services/InboxRepositoryService.php");
require_once (dirname(__DIR__)."/domain/Session.php");
$patron = "/^[[:digit:]]+$/";

$mysession = new Session();
$mysession->initSession();


$inboxRepo = new InboxRepositoryService();

if (isset($_SESSION['id']) and preg_match($patron,$_SESSION['id']) and isset($_GET['usuarioRemitent']) and preg_match($patron,$_GET['usuarioRemitent'])){

    $userRemitentIdFirst = $_SESSION['id'];

    $userRemitentIdSecond = $_GET['usuarioRemitent'];

    $inboxIdFirst = $inboxRepo -> getInboxIdByUserId($userRemitentIdFirst);

    $inboxIdSecond = $inboxRepo -> getInboxIdByUserId($userRemitentIdSecond);

    $messages = $inboxRepo -> getMessagesOfChat($userRemitentIdFirst, $inboxIdFirst, $userRemitentIdSecond, $inboxIdSecond);

}
if($messages != null){
    $i = 1;
    while($message = $messages -> fetch_object()) {
        if($message -> id_usuario == $userRemitentIdFirst ) {
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
    $i++;
    }
}else{
    echo "ERROR: No se pudo obtener informacion de la Base de Datos";
}
echo "<input type='hidden' id='inpTotalPrivateMsg' name='inpTotalPrivateMsg' value=".$i.">";
?>
