<?php
require_once (dirname(__DIR__)."/services/InboxRepositoryService.php");

$inboxRepo = new InboxRepositoryService();

$userRemitentId = $_SESSION['id'];

$userRecipientId = $_GET['usuario'];

$inboxRepo -> getMessagesOfChat($userRemitentId, $userRecipientId);


?>
