<?PHP
    require_once (dirname(__DIR__)."/domain/User.php");
    require_once (dirname(__DIR__)."/domain/Wall.php");
    require_once (dirname(__DIR__)."/services/WallRepositoryService.php");

    $patron = "/^[[:digit:]]+$/";
    if(preg_match($patron,$_GET['usuario'])) {
        $idUsuario = $_GET['usuario'];
    }else{
        header ('location:index.php?error=4');
        exit;
    }

    $wallRepo = new WallRepositoryService();

    $wallResult = $wallRepo -> getWallByUserId($idUsuario);
    //
    $MessageLimitResult = $wallRepo -> getMessageLimit($idUsuario);//
    $MessageNumResult = $wallRepo -> getMessageNum($idUsuario);//


    if($wallResult -> num_rows > 0){
        $userHasWall = true;
    }else{
        $userHasWall = false;
    }

    if($userHasWall){
        $objWall = $wallResult -> fetch_object();
        $privacidad = $objWall -> privacidad;
        $idMuro = $objWall -> id_muro;
        $anonimoLectura = $objWall -> flag_anonimo_lectura;
        $anonimoEscritura = $objWall -> flag_anonimo_escritura;
        
        $objLimit = $MessageLimitResult -> fetch_object();
        $limitPrivateMsg = $objLimit -> limite;//limite de mensaje de la bandeja de entrada $limiteMensajePri
        $IdBandeja = $objLimit -> id_bandeja;

        $totalPrivateMsg = $MessageNumResult;//cantidad de mensajes en bandeja de entrada

        $wall = new Wall();
        $messages = $wall -> getMessages();

        if($messages -> num_rows > 0)
        {
            while($obj = $messages -> fetch_object()){
                $mensajes[] = $obj -> contenido;
                $nombre = $obj -> nombre;
                $apellido = $obj -> apellido;
                $rows[] = $obj;
            }
        };

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
    };


?>