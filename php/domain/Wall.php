<?php

require (dirname(__DIR__)."/connection/Connection.php");

class Wall{
	
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
		$myConnection = new Connection();
		$mySession = new Session();
			
			$result1 = $myConnection -> query("SELECT * FROM MENSAJE WHERE id_muro='$this->id_wall';");
			
		if($row1 = $result1 -> fetch_object()){//Devuelve la fila actual de un conjunto de resultados como un objeto
			
			$mySession -> initSession();
			$mySession -> setSession('idMessage',$fila->id_mensaje);
			$mySession -> setSession('idUser',$fila->id_usuario);
			$mySession -> setSession('idWall',$fila->id_muro);
			$mySession -> setSession('idContent',$fila->contenido);
			$mySession -> setSession('idDate',$fila->fecha);
			
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
		}
			
		$myConnection -> close();
	}

	//Posterior a dar de baja un usuario llamo a este método pasandole por parámetro el id del usuario.
	public function remove($id_usuario){
		//Busco el muro que corresponde con el id al usuario que se borró.

		$qb = new Querybuilder();
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
}

?>