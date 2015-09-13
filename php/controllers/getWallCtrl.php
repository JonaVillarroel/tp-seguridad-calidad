<?PHP
	require_once (dirname(__DIR__)."/domain/User.php");
	require_once (dirname(__DIR__)."/domain/Wall.php");

    $wall = new Wall();
    $muro = $wall -> getMessages();

    while($obj = $muro -> fetch_object()){
    	$privacidad = $obj -> privacidad;
    	$mensajes[] = $obj -> contenido;
    	$idMuro = $obj -> id_muro;
        $nombre = $obj -> nombre;
        $apellido = $obj -> apellido;
        $rows[] = $obj;
    }
    if(isset($_SESSION["id"])){
    	$allow = $wall -> isInWhiteList($idMuro, $_SESSION["id"]);
    	$userAllow = $allow -> fetch_array(MYSQLI_NUM);
    }else
    	$userAllow = false;

    $userMuro = new User();
    $result = $userMuro -> getUser($_GET['usuario']);

    if($obj = $result -> fetch_object()){
        $nombreMuro  = $obj -> nombre;
        $apellidoMuro = $obj -> apellido;
    }
?>