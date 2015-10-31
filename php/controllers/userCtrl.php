<?php
require_once (dirname(__DIR__)."/services/UserRepositoryService.php");
require_once (dirname(__DIR__)."/security/CaesarCipher.php");
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

//1) este codigo ya lo use en getWallCtrl.php pero no sé cómo heredarlo
    $MessageLimitResult = $inboxRepo -> getMessageLimit($toUser);//
    $MessageNumResult = $inboxRepo -> getMessageNum($toUser);//
    $objLimit = $MessageLimitResult -> fetch_object();
    $limitPrivateMsg = $objLimit -> limite;//limite de mensaje de la bandeja de entrada $limiteMensajePri
    $IdBandeja = $objLimit -> id_bandeja;

    $totalPrivateMsg = $MessageNumResult;//cantidad de mensajes en bandeja de entrada
//1)FIN

    if($resultInbox -> fecha_baja == null){
        $recipientInboxId = $resultInbox -> id_usuario;

        $senderInboxId = $inboxRepo -> getInboxIdByUserId($userIdSender);

        $conversationId = $inboxRepo -> getConversationIdByInboxId($recipientInboxId, $userIdSender, $senderInboxId, $toUser);

        if($conversationId == null){
            $lastId = $inboxRepo -> getLastConversationId();

            $conversationId = $lastId+1;
        };

        if(strlen($content)<=200){//controlo que el contenido del mensaje no supere los 200 caracteres
            if ($totalPrivateMsg < $limitPrivateMsg) {//Verificando que no se envíen más mensajes de los permitidos
                $caesarCipher = new CaesarCipher($content);
                $content = $caesarCipher->encryptMessage();
                $results = $inboxRepo -> postMessage($recipientInboxId, $userIdSender, $content, $conversationId);
            }else{
                $response['errorMsg'] = "Lo sentimos, hubo la casilla de mensajes está llena.";
                $response['valid'] = false;
            }
        }else{
            $response['errorMsg'] = "Lo sentimos, el largo del mensaje supera los 200 caracteres permitidos.";
            $response['valid'] = false;
        } 

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