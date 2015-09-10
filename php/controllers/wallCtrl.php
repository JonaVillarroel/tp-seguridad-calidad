<?php
require_once (dirname(__DIR__)."/services/WallRepositoryService.php");
require_once (dirname(__DIR__)."/services/UserRepositoryService.php");
require_once (dirname(__DIR__)."/domain/Session.php");

execute($_POST['action']);

function execute($action){
    switch($action)
    {
        case "remove": removeUser($_POST['userNameRemove']);
            break;
    }

}


function removeUser($userNameRemove){
    $mysession = new Session();
    $mysession->initSession();

    $wallRepo = new WallRepositoryService();
    $userRepo = new UserRepositoryService();

    $userName = $_SESSION['userUserName'];

    $wallId = $wallRepo -> getWallIdByUserName($userName);

    $userIdRemove = $userRepo -> getUserIdByName($userNameRemove);

    $results = $wallRepo -> removeUser($userIdRemove, $wallId);

    if($results === TRUE)
    {
        $response['valid'] = true;
    }else{
        $response['errorMsg'] = "Lo sentimos, hubo un error al eliminar el usuario de su lista.";
        $response['valid'] = false;
    }

    echo json_encode($response);

}

?>