<?php
class Wall extends Connection{
	
	private $id_wall;
	private $id_user;
	private $privacity;
	private $date_leaving;

	#Datos Muro [id_muro auto_increment,id_usuario,privacidad set('propietario','todos','registrados')]
	public function __construct(){	
	}
	
	public function getMessages($tope,$idUsuario){

	    $db = new Connection();
		$limite = $tope;

	    $query = "SELECT MENSAJE.contenido, USUARIO.nombre, USUARIO.apellido, MURO.privacidad,MENSAJE.fecha_alta
					FROM MENSAJE
					INNER JOIN MURO ON MENSAJE.id_muro = MURO.id_muro
					INNER JOIN USUARIO ON USUARIO.id_usuario = MENSAJE.id_usuario
					WHERE MURO.id_usuario = ?
					ORDER BY fecha_alta DESC LIMIT ? ";

		$stmt = $db -> prepare($query);
		$stmt -> bind_param("ii", $idUsuario, $limite);
		$stmt -> execute();
		$stmt->bind_result($contenido, $nombre, $apellido, $privacidad,$fecha_alta);
		$rows = 0;
		$row = Array();
		$result = $stmt->get_result();
		$obj = new stdClass();
		while ($obj = $result->fetch_object()) {
			$rows++;
			$row[] = $obj;
		}


		if($rows > 0){
			return $row;
		}else{
			return null;
		}
	}

	public function getWallByUser($userName){

		$query = "SELECT id_muro FROM MURO INNER JOIN USUARIO ON
					MURO.id_usuario = USUARIO.id_usuario
					WHERE USUARIO.nombre_usuario = '$userName'";

		$results = $this->db->query($query)
		or die('Error consultando el usuario: ' . mysqli_error($this->db));

		$obj = $results -> fetch_object();

		$wallId = $obj -> id_muro;

		return $wallId;
	}


	public function isInWhiteList($idMuro, $loggedUserId){
		$db = new Connection();

	    $query = "SELECT * FROM COMPARTE_CON WHERE id_muro = '$idMuro' AND id_usuario = '$loggedUserId'";

	    $results = $db -> query($query)
	    or die('Error consultando la lista blanca: ' . mysqli_error($this->db));

	    return $results;
	}

	// Modifica el límite de mensajes publicos
	public function modifyLimitAllWall($limit){
		$myConnection = new Connection();

		//verifico que sea un número positivo
		if(is_numeric($limit)) {
			if($limit >= 0){
				$myConnection -> query("UPDATE MURO SET MURO.limite_muro = '$limit';");
			}
		}
		else {
			header ('location: ../../indexAdmin.php?malahi');
		}

		$myConnection -> close();

		header ('location: ../../indexAdmin.php');
	}

}

?>