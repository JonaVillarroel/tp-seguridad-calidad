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

	    $db = new Connection();
	    $muro = 1;

	    $query = "SELECT * FROM MENSAJE WHERE id_muro = '$muro' ORDER BY fecha_alta DESC LIMIT 10";

	    $results = $db -> query($query)
	    or die('Error consultando los mensajes: ' . mysqli_error($this->db));

	    return $results;

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

		$query = "SELECT id_muro FROM MURO INNER JOIN USUARIO ON
					MURO.id_usuario = USUARIO.id_usuario
					WHERE USUARIO.nombre_usuario = '$userName'";

		$results = $this->db->query($query)
		or die('Error consultando el usuario: ' . mysqli_error($this->db));

		$obj = $results -> fetch_object();

		$wallId = $obj -> id_muro;

		return $wallId;


	}
}

?>