<?php
require_once (dirname(__DIR__)."/services/UserRepositoryService.php");
require_once (dirname(__DIR__)."/services/InboxRepositoryService.php");
require_once (dirname(__DIR__)."/domain/Session.php");

execute($_POST['action']);

function execute($action){
    switch($action)
    {
        case "getPrivateMessages": getPrivateMessages($_POST['toUser']);
            break;
    }

}

function getPrivateMessages($toUser){
    $mysession = new Session();
    $mysession->initSession();

    $inboxRepo = new InboxRepositoryService();
    $userRepo = new UserRepositoryService();

    $userIdSender = $_SESSION['id'];

    $inboxId = $inboxRepo -> getInboxIdByUserId($toUser);

    $results = $inboxRepo -> postMessage($inboxId, $userIdSender, $content);

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