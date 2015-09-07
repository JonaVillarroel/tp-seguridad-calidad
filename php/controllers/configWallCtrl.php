<?php
require_once (dirname(__DIR__)."/services/WallRepositoryService.php");
require_once (dirname(__DIR__)."/services/UserRepositoryService.php");
require_once (dirname(__DIR__)."/domain/Session.php");
$mysession = new Session();
$mysession->initSession();

$wallRepo = new WallRepositoryService();
$userRepo = new UserRepositoryService();


$json = $_POST['data'];
$data = json_decode($json, true);

$newData['privacity'] = $data['opt'];

$userName = $_SESSION['userUserName'];

$newData['wallId'] = $wallRepo -> getWallIdByUserName($userName);

//Obtengo el userId de cada userName
foreach($data['users'] as $user){

    $newUsers[] = $userRepo -> getUserIdByName($user);
}

$newData['users'] = $newUsers;
$result = $wallRepo -> updatePrivacity($newData);


?>