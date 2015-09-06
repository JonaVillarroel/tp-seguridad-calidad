<?PHP
	require_once (dirname(__DIR__)."/domain/User.php");
	require_once (dirname(__DIR__)."/domain/Wall.php");

    $wall = new Wall();
    $muro = $wall -> getMessages();
    while($obj = $muro -> fetch_object()){
    	$privacidad = $obj -> privacidad;
    	$mensajes[] = $obj -> contenido;
    	$idMuro = $obj -> id_muro;
    }
    if(isset($_SESSION["idUser"])){
    	$allow = $wall -> isInWhiteList($idMuro, $_SESSION["idUser"]);
    	$userAllow = $allow -> fetch_array(MYSQLI_NUM);
    }else
    	$userAllow = false;
?>