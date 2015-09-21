<?php
require_once (dirname(__DIR__)."/services/UserRepositoryService.php");
require_once (dirname(__DIR__)."/services/InboxRepositoryService.php");
require_once (dirname(__DIR__)."/domain/Session.php");

execute($_POST['action']);

function execute($action){
    switch($action)
    {
        case "sendPrivateMessage": sendPrivateMessage($_POST['content'], $_POST['toUser']);
            break;
/*        case "removePrivateMessage": sendPrivateMessage($_POST['messageId']);
            break;*/
    }

}

/*function removePrivateMessage($messageId){
    $mysession = new Session();
    $mysession->initSession();

    $inboxRepo = new InboxRepositoryService();

    $userIdSender = $_SESSION['id'];

    $results = $inboxRepo -> removeMessageById($messageId);

    if($results === TRUE)
    {
        $response['valid'] = true;
    }else{
        $response['errorMsg'] = "Lo sentimos, hubo un error al eliminar el mensaje.";
        $response['valid'] = false;
    }
}*/


function sendPrivateMessage($content, $toUser){
    $mysession = new Session();
    $mysession->initSession();

    $inboxRepo = new InboxRepositoryService();
    $userRepo = new UserRepositoryService();

    $userIdSender = $_SESSION['id'];


    $resultsInbox = $inboxRepo -> getInboxIdAndLeaveDateByUserId($toUser);

    $resultInbox = $resultsInbox -> fetch_object();

    if($resultInbox -> fecha_baja == null){
        $recipientInboxId = $resultInbox -> id_usuario;

        $senderInboxId = $inboxRepo -> getInboxIdByUserId($userIdSender);

        $conversationId = $inboxRepo -> getConversationIdByInboxId($recipientInboxId, $userIdSender, $senderInboxId, $toUser);

        if($conversationId == null){
            $lastId = $inboxRepo -> getLastConversationId();

            $conversationId = $lastId+1;
        };

        $results = $inboxRepo -> postMessage($recipientInboxId, $userIdSender, $content, $conversationId);

        if($results === TRUE)
        {
            $response['valid'] = true;
        }else{
            $response['errorMsg'] = "Lo sentimos, hubo un error al enviar el mensaje.";
            $response['valid'] = false;
        }

    }else{
        $response['valid'] = false;
        $response['errorMsg'] = "Lo sentimos, este usuario ha sido dado de baja.";
    }

    echo json_encode($response);
}

?>