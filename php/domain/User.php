<?php
require_once(dirname(__DIR__)."/connection/Connection.php");
require_once(dirname(__DIR__)."/domain/Session.php");
require_once(dirname(__DIR__)."/domain/Message.php");
require_once(dirname(__DIR__)."/services/WallRepositoryService.php");
require_once(dirname(__DIR__)."/services/InboxRepositoryService.php");
require_once(dirname(__DIR__)."/controllers/redirect.php");
require_once(dirname(__DIR__)."../../securimage/securimage.php");



class User{
    private $rol;
	private $name;
	private $surname;
    private $mail;
	private $userName;
    private $pass;
	private $status;
	private $dateLeaving;
	
	/*id_usuario int not null auto_increment primary key,
	rol set('Administrador','Comun'),
	nombre varchar(30),
	apellido varchar(30),
	mail varchar(50),
	nombre_usuario varchar(30),
	contraseña varchar(50),
	estado SET ('Registrado', 'Pendiente') not null,
	fecha_baja date*/

    public function __construct(){}

    public function SignUp($name,$surname,$mail,$userName,$pass,$repass,$emailf,$namef,$captcha_code){
		$myConnection = new Connection();
		
        //Valido los datos
        $errorMessage = self::validate($name,$surname,$mail,$userName,$pass,$repass,$emailf,$namef,$captcha_code);

        $isError = false;
        $errorMessageView = "";
        foreach($errorMessage as $error){
            if( $error !== 0 ){
                $isError = true;
                $errorMessageView = $errorMessageView . $error."<br>";
            }
        }
		
        if($isError){
            //Informo que hay errores y el mensaje de error
            echo $errorMessageView;
        }else{
            //Verifico que el mail y nombre de usuario no estén en uso
            $errorMessageView = self::verify($mail, $userName);

            if(strlen($errorMessageView) > 1){
                //Informo.
                echo $errorMessageView;
            }else{
                //Procedo a insertar los datos a la bdd.
                $surnameOK = ucfirst(strtolower($surname));#Primer letra mayucula y el resto de lo que escribo en minuscula
				$nameOK = ucfirst(strtolower($name));#Primer letra mayucula y el resto de lo que escribo en minuscula

                $pass = sha1($myConnection -> real_escape_string($pass));

				$myConnection -> query("INSERT INTO USUARIO (id_usuario,rol,nombre,apellido,mail,nombre_usuario,contraseña,estado, fecha_baja) VALUES
				('','Comun','$nameOK','$surnameOK','$mail','$userName','$pass','Pendiente', null);");

                $lastID = $myConnection -> insert_id;

                $wall = new WallRepositoryService();
                $wall -> createWall($lastID);
                $inbox = new InboxRepositoryService();
                $inbox -> createInbox($lastID);

                echo "<div class='col-sm-12'>";
	                echo "<div class='jumbotron col-sm-6 col-sm-push-3'>";
		                    echo "<h1 class='text-center'>Usuario registrado</h1>";
                            echo "<a class='btn btn-primary btn-lg pull-right' href='../../index.php' role='button'>Inicio</a>";
                    echo "</div>";
                echo "</div>";
            }
        }
		$myConnection -> close();
    }

    public function Login($mail, $pass){
        $myConnection = new Connection();
        $mysession = new Session();

        $pass = sha1($myConnection -> real_escape_string($pass));

        $result = $myConnection -> query("SELECT * FROM USUARIO WHERE mail = '$mail' AND contraseña = '$pass' AND fecha_baja is null;");
        if($row = $result -> fetch_object()) {//Devuelve la fila actual de un conjunto de resultados como un objeto
            if ($row->estado == 'Registrado') {

                $mysession->initSession();
                $mysession->setSession('id', $row->id_usuario);
                $mysession->setSession('nombre', $row->nombre);
                $mysession->setSession('apellido', $row->apellido);
                $mysession->setSession('mail', $row->mail);
                $mysession->setSession('usuario', $row->nombre_usuario);
                $mysession->setSession('rol', $row->rol);
                $mysession->setSession('estado', $row->estado);
                $rol = $row->rol;

                switch ($rol) {
                    case 'Administrador':
                        header ('location: ../../indexAdmin.php');
                        break;
                    case 'Comun':
						header ('location: ../../index.php?usuario='.$_SESSION['id']);
                        break;
                }

            } else if ($row->estado == 'Pendiente') {
                echo "<div class='col-sm-12'>";
                    echo "<div class='jumbotron col-sm-6 col-sm-push-3'>";
                        echo "<h1 class='text-center'>Disculpe Las Moletias<br/></h1>";
                        echo "<p>Usuario " . $row->nombre . " " . $row->apellido . " su solicitud de registro todavia no fue confirmada por el Administrador del sitio.</p>";
                        echo "<a class='btn btn-primary btn-lg pull-right' href='../../index.php' role='button'>Inicio</a>";
                    echo "</div>";
                echo "</div>";
            }
        }else{
            header ('location: ../../index.php?error=1');
        }

		$myConnection->close();
    }

    //Recibe el nombre de usuario ACTUAL, y un json con los datos que el usuario modificó en el formulario
    /*public function update($userName, $dataToModificate){
        $errorMessageView = "";
        $where = "'$userName' = nombre_usuario";
        $mail = $dataToModificate['mail'];
        $queryBuilder = new QueryBuilder();

        //Valido que los datos sean válidos.
        $errorMessage = self::validate($dataToModificate);

        $isError = false;
        $errorMessageView = "";
        foreach($errorMessage as $error){
            if( $error !== 0 ){
                $isError = true;
                $errorMessageView = $errorMessageView . $error."<br>";
            }
        }

        if($isError){
            //Informo que hay errores y el mensaje de error
            echo $errorMessageView;
        }else{
            //Verifico que el mail y nombre de usuario no estén en uso

            $errorMessageView = self::verify($mail, $userName);

            if( sizeof($errorMessageView) >= 1){
                //Informo.
                echo $errorMessageView;
            }else{
                //Procedo a updatear los datos a la bdd.
                $queryBuilder->update('USUARIO', $dataToModificate, $where);
                echo "Datos modificados";
            }
        }

    }*/

	public function getUser($userId){
        $myConnection = new Connection();
		
		$result = $myConnection -> query("SELECT * FROM USUARIO WHERE USUARIO.id_usuario = '$userId';");
		
		$myConnection -> close();
		return $result;
    }
	
	public function getUsersStatusPending(){
        $myConnection = new Connection();
		
		$result = $myConnection -> query("SELECT * FROM USUARIO WHERE estado = 'Pendiente' AND fecha_baja IS NULL;");
		
		$myConnection -> close();
		return $result;
    }
	
	public function getUsersStatusCurrent(){
        $myConnection = new Connection();
		
		$result = $myConnection -> query("SELECT * FROM USUARIO WHERE estado = 'Registrado' AND fecha_baja IS NULL;");
		
		$myConnection -> close();
		return $result;
    }
	
	public function getUsersStatusDisapprove(){
        $myConnection = new Connection();
		
		$result = $myConnection -> query("SELECT * FROM USUARIO WHERE fecha_baja IS NOT NULL;");
		
		$myConnection -> close();
		return $result;
    }
	
	public function approveUser($userId){
		$myConnection = new Connection();
		
		$result = $myConnection -> query("UPDATE USUARIO SET USUARIO.estado = 'Registrado' WHERE USUARIO.id_usuario = '$userId';");
		
		$myConnection -> close();
		header ('location: ../../indexAdmin.php?list=request');
    }
	
	public function modifyUser($userId,$name,$surname,$mail,$userName){
		$myConnection = new Connection();

                //Procedo a insertar los datos a la bdd.
                $surnameOK = ucfirst(strtolower($surname));#Primer letra mayucula y el resto de lo que escribo en minuscula
				$nameOK = ucfirst(strtolower($name));#Primer letra mayucula y el resto de lo que escribo en minuscula

				if(($name != null or $name != '') AND (preg_match("/^[a-zA-ZñÑáéíóÁÉÍÓÚ]*$/",$name))){
					$result = $myConnection -> query("UPDATE USUARIO SET USUARIO.nombre = '$nameOK' WHERE USUARIO.id_usuario = '$userId';");
				}
				if(($surname != null or $surname != '') AND (preg_match("/^[a-zA-ZñÑáéíóÁÉÍÓÚ]*$/",$surname))){
					$result = $myConnection -> query("UPDATE USUARIO SET USUARIO.apellido = '$surnameOK' WHERE USUARIO.id_usuario = '$userId';");
				}
				if(($mail != null or $mail != '') AND (preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/",$mail))){
					$result = $myConnection -> query("UPDATE USUARIO SET USUARIO.mail = '$mail' WHERE USUARIO.id_usuario = '$userId';");
				}
				if(($userName != null or $userName != '') AND (preg_match("/^[a-zA-ZñÑáéíóÁÉÍÓÚ]*$/",$name))){
					$result = $myConnection -> query("UPDATE USUARIO SET USUARIO.nombre_usuario = '$userName' WHERE USUARIO.id_usuario = '$userId';");
				}
				
                header ('location: ../../indexAdmin.php?list=current');

		$myConnection -> close();
    }
	
	public function disapproveUser($userId){
		$myConnection = new Connection();
		
		// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
		date_default_timezone_set('GMT-3');
		$currentDate = date('Y-m-d');
		$result = $myConnection -> query("UPDATE USUARIO SET USUARIO.fecha_baja = '$currentDate' WHERE USUARIO.id_usuario = '$userId';");
		
		$myConnection -> close();
		header ('location: ../../indexAdmin.php?list=current');
    }
	
	private function validate($name,$surname,$mail,$userName,$pass,$repass,$emailf,$namef,$captcha_code){
        $errorMessage = array();
        $securimage = new Securimage();

        if(preg_match("/^[a-zA-ZñÑáéíóÁÉÍÓÚ]*$/",$name)){
            $errorMessage["name"] = 0;
        }else{
            $errorMessage["name"] = "El nombre no es correcto";
        }

        if(preg_match("/^[a-zA-ZñÑáéíóÁÉÍÓÚ]*$/",$surname)){
            $errorMessage["name"] = 0;
        }else{
            $errorMessage["name"] = "El nombre no es correcto";
        }

        if(preg_match("/[\w]{6,}/",$pass)){
            $errorMessage["pass"] = 0;
        }else{
            $errorMessage["pass"] = "La contraseña no es correcta";
        }

        if($repass == $pass){
            $errorMessage["repass"] = 0;
        }else{
            $errorMessage["repass"] = "Las contraseñas no coinciden";
        }

        if(preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/",$mail)){
            $errorMessage["mail"] = 0;
        }else{
            $errorMessage["mail"] = "El mail ingresado no es válido";
        }
		
		if(preg_match("/^[a-zA-ZñÑáéíóÁÉÍÓÚ]*$/",$userName)){
            $errorMessage["userName"] = 0;
        }else{
            $errorMessage["userName"] = "El nombre de usuario no es correcto";
        }
            //AntiSpam
        if(strlen($emailf)==0){
            $errorMessage["emailf"] = 0;
        }else{
             $errorMessage["emailf"] = "Campo vacio";
             redirect('http://www.google.com');
            
        }
        if(strlen($namef)==0){
            $errorMessage["namef"] = 0;
        }else{
             $errorMessage["namef"] = "Campo vacio";
             redirect('http://www.google.com');
            
        }
        if ($securimage->check($_POST['captcha_code']) == false) {
            $errorMessage["captcha_code"] = "captcha erroneo";

            echo "El captcha ingresado es incorrecto.<br /><br />";

            echo "Por favor <a href='javascript:history.go(-1)'>regrese</a>  e inténtelo de nuevo .";

        } else {
            $errorMessage["captcha_code"] = 0;
        }

        return $errorMessage;
    }

    private function verify($mail, $userName){
        $myConnection = new Connection();
        $errorMessageView = "";
		
		$result1 = $myConnection -> query("SELECT * FROM USUARIO WHERE nombre_usuario = '$userName';");
		$numberOfRows1 = mysqli_num_rows($result1);
        if($numberOfRows1 > 0){
            $userExist = true;
            $errorMessageView = "El usuario ingresado ya existe<br>";
        }else{
			$userExist = false;
        }
		
		$result2 = $myConnection -> query("SELECT * FROM USUARIO WHERE mail = '$mail';");
		$numberOfRows2 = mysqli_num_rows($result2);
        if($numberOfRows2 > 0){
            $mailExist = true;
            $errorMessageView = "El mail ingresado ya existe<br>";
        }else{
			$mailExist = false;
        }
		
		$myConnection -> close();
        return $errorMessageView;
    }

}

?>

