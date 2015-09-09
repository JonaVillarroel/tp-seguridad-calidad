<?php
require_once (dirname(__DIR__)."/services/UserRepositoryService.php");

$userRepo = new UserRepositoryService();

$userName = $_POST['userName'];

$result = $userRepo -> verifyUser($userName);

if($result == null)
{
    $response['errorMsg'] = "Lo sentimos, el usuario ingresado no existe.";
    $response['valid'] = false;
}else{
    $response['valid'] = true;
}

echo json_encode($response);
?>