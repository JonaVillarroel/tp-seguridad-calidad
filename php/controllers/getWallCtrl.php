<?PHP
	require_once (dirname(__DIR__)."/domain/User.php");
	require_once (dirname(__DIR__)."/domain/Wall.php");

    $wall = new Wall(1,1,"publico");
    $muro = $wall -> getMessages();

?>