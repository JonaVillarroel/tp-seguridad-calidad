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

    if(isset($_SESSION['usuario']) and preg_match("/^[a-zA-ZñÑáéíóÁÉÍÓÚ]*$/",$_SESSION['usuario'])) {
        $userName = $_SESSION['usuario'];
        $newData['wallId'] = $wallRepo->getWallIdByUserName($userName);
        
        if($data['opt'] == 'private'){
            //Obtengo el userId de cada userName
            $newUsers = Array();
            foreach($data['users'] as $user){
                $newUsers[] = $userRepo -> getUserIdByName($user);
            }
            $newData['users'] = $newUsers;

        }else if($data['opt'] == 'semiprivate') {
            //Obtengo el userId de cada userName
            $newUsers = Array();
            foreach($data['users'] as $user){
                $newUsers[] = $userRepo -> getUserIdByName($user);
            }
            $newData['users'] = $newUsers;

        };

        $wallRepo -> updatePrivacity($newData);
    }else{
        echo "ERROR: No se pudo obtener el muro del usuario";
    }

?>