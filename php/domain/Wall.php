<?php

class Wall extends Connection{
	
	private $id_wall;
	private $id_user;
	private $privacity;
	private $date_leaving;

	#Datos Muro [id_muro auto_increment,id_usuario,privacidad set('propietario','todos','registrados')]
	public function __construct($idMuro,$idUsuario,$privacidad){	
		$this -> id_wall = $idMuro;
		$this -> id_user = $idUsuario;
		$this -> privacity = $privacidad;
	}
	
	public function getMessages(){

		$con = new Connection();
		$sql = "SELECT * FROM MENSAJE WHERE id_muro=?";
		$stmt = $con->prepare($sql);
		$valor = 1;
		if($stmt === false) {
  			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $con->error, E_USER_ERROR);
		}
		$stmt->bind_param('i',$valor);

		$stmt->execute();

		$stmt->bind_result($id_mensaje, $id_usuario, $id_muro, $contenido, $fecha_alta, $fecha_baja);

		while($row = $stmt->fetch())
		{
  			printf ("%s \n", $contenido);
		}


/*$arr = $rs->fetch_all(MYSQLI_ASSOC);
 
if($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $rows_returned = $rs->num_rows;
}


		if($fila = $result -> fetch_object()){//Devuelve la fila actual de un conjunto de resultados como un objeto
			
			$mySession -> initSession();
			$mySession -> setSession('idMessage',$fila->id_mensaje);
			$mySession -> setSession('idUser',$fila->id_usuario);
			$mySession -> setSession('idWall',$fila->id_muro);
			$mySession -> setSession('idContent',$fila->contenido);
			$mySession -> setSession('idDate',$fila->fecha_baja);
					
			$result2 = $myConnection -> query("SELECT * FROM USUARIO WHERE id_usuario='$fila->id_usuario';");
				if($row2 = $result2 -> fetch_object()){
					$typeUser = $row2 -> rol;
					$idUser = $row2 -> id_usuario;
					switch($typeUser){			
						case 'adminUser':
							header('location: Administrador/index.php?idUser='.$idUser);//Redirecciono al index.php dentro de la carpeta Administrador
						break;
						case 'simpleUser':
							header('location: Comun/index.php?idUser='.$idUser);//Redirecciono al index.php dentro de la carpeta Comun
						break;				
					}
				}
		}
		else{
			//header ('location: ../index.php?error=1');
		}*/
			
		$con -> close();
	}

	//Posterior a dar de baja un usuario llamo a este método pasandole por parámetro el id del usuario.
	public function remove($id_usuario){
		//Busco el muro que corresponde con el id al usuario que se borró.
		$result =  $qb.simple_select('MURO', 'id_muro', 'id_usuario', $id_usuario);

		if($result->num_rows === 0)
		{
			//No existe un muro que corresponda a ese usuario
		}else
		{
			//Existe un muro que corresponde a ese usuario entonces procedo a darle de baja.
			$object = $result->fetch_object();
			$id_muro = $object->id_muro;
			$values['fecha_baja'] = new Date();
			$qb.simple_update('MURO',$values ,'id_muro', $id_muro);
		}

	}

	public function getWallByUser($userName){

		$query = "SELECT id_usuario FROM MURO INNER JOIN USUARIO ON
					MURO.id_usuario = USUARIO.id_usuario
					WHERE USUARIO.nombre_usuario = '$userName'";

		$results = $this->db->query($query)
		or die('Error consultando el usuario: ' . mysqli_error($this->db));


	}
}

?>