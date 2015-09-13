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

$userName = $_SESSION['usuario'];

$newData['wallId'] = $wallRepo -> getWallIdByUserName($userName);

if($data['opt'] == 'opt-1' || $data['opt'] == 'opt-2')
{
    //Obtengo el userId de cada userName
    $newUsers = Array();
    foreach($data['users'] as $user){
        $newUsers[] = $userRepo -> getUserIdByName($user);
    }
    $newData['users'] = $newUsers;
};

$wallRepo -> updatePrivacity($newData);

?>