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
    }

}


function sendPrivateMessage($content, $toUser){
    $mysession = new Session();
    $mysession->initSession();

    $inboxRepo = new InboxRepositoryService();
    $userRepo = new UserRepositoryService();

    $userIdSender = $_SESSION['id'];

    $recipientInboxId = $inboxRepo -> getInboxIdByUserId($toUser);

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

    echo json_encode($response);
}

?>