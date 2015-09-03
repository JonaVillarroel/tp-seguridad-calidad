<?php
require(dirname(__DIR__)."/connection/Querybuilder.php");

define("PENDIENTE","Pendiente");
define("COMUN","Comun");
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

    public function SignUp($name,$surname,$mail,$userName,$pass,$repass){
		$queryBuilder = new Querybuilder();
		
        //Valido los datos
        $errorMessage = self::validate($name,$surname,$mail,$userName,$pass,$repass);

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
                //Procedo a insertar los datos a la bdd.
                $surnameOK = ucfirst(strtolower($surname));#Primer letra mayucula y el resto de lo que escribo en minuscula
				$nameOK = ucfirst(strtolower($name));#Primer letra mayucula y el resto de lo que escribo en minuscula
			
				$values['rol'] = $COMUN;
				$values['nombre'] = $nameOK;
				$values['apellido'] = $surnameOK;
				$values['mail'] = $mail;
				$values['nombre_usuario'] = $userName;
				$values['contraseña'] = $pass;
				$values['estado'] = $PENDIENTE;
			
				$queryBuilder -> insert('USUARIO', $values);
                echo "Usuario registrado";
            }
        }
    }

    public function Login($userName, $pass){
        $this -> userName = $userName;
        $this -> pass = $pass;

        $query = "SELECT nombre_usuario, rol FROM USUARIO where nombre_usuario = '$userName' and pass = '$pass'";
        $result = $this->db->query($query) or die( "Error en el SELECT: ".mysqli_error($this->db) );
        if($result->num_rows === 1){
            $canLogin = true;
        }
        while ($obj = $result->fetch_object()) {
            $userName = $obj->nombre_usuario;
            if ($obj->rol === "adminUser") {
                $isAdmin = true;
            } else {
                $isAdmin = false;
            }
        }

        //Si existe el usuario puedo loguearme.
        if($canLogin){
            $data['valido'] = true;
            $data['message'] = "Todos los datos correctos.<br/>" ;
            session_start();
            $_SESSION['userName'] = $userName;
            if($isAdmin){
                $_SESSION['rol'] = "adminUser";
            }else{
                $_SESSION['rol'] = "simpleUser";
            }
        }else{
            $data['valido'] = false;
        }
        echo json_encode($data);
    }

    //Recibe el nombre de usuario ACTUAL, y un json con los datos que el usuario modificó en el formulario
    public function update($userName, $dataToModificate){
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

    }

    private function validate($name,$surname,$mail,$userName,$pass,$repass){
        $errorMessage = array();


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

        if(preg_match("/^[a-zA-Z0-9_ñÑáéíóÁÉÍÓÚ]*[@]+[a-z]+([.]{1}[a-z]+)*$/",$mail)){
            $errorMessage["mail"] = 0;
        }else{
            $errorMessage["mail"] = "El mail ingresado no es válido";
        }

        return $errorMessage;
    }

    private function verify($mail, $userName){
        $queryBuilder = new Querybuilder();
        $errorMessageView = "";
		
        $result1 = $queryBuilder->select('USUARIO','nombre_usuario',"nombre_usuario='$userName'");
        if($result1->num_rows === 0){
            $userExist = false;
        }else{
            $userExist = true;
            $errorMessageView += "El usuario ingresado ya existe<br>";
        }
		
		$result2 = $queryBuilder->select('USUARIO','mail',"mail='$mail'");
        if($result2->num_rows === 0){
            $mailExist = false;
        }else{
            $mailExist = true;
            $errorMessageView += "El mail ingresado ya existe<br>";
        }

        return $errorMessageView;
    }

    /**
    Recibe un json con:
    * @param id_usuario
    * @param id_muro
    * @param content
    */
    public function postMessage($content, $fromUser, $toWall){

        $message = new Message($content, $toWall, $fromUser);

    }



}

?>

