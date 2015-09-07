<?php
require_once (dirname(__DIR__)."/services/WallRepositoryService.php");
require_once (dirname(__DIR__)."/services/UserRepositoryService.php");

$wallRepo = new WallRepositoryService();
$userRepo = new UserRepositoryService();


$json = $_POST['data'];
$data = json_decode($json, true);

$newData['privacity'] = $data['opt'];

$userName = $_SESSION['userName'];
$newData['wallId'] = $wallRepo -> getWallIdByUserName($userName);

//Obtengo el userId de cada userName
foreach($data['users'] as $userName){

    $newUsers[] = $userRepo -> getUserIdByName($userName);
}

$newData['users'] = $newUsers;
$result = $wallRepo -> updatePrivacity($newData);


?>