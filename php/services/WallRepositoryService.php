<?php
require_once (dirname(__DIR__)."/connection/Connection.php");

class WallRepositoryService{
    var $db;

    public function __construct(){
        $this -> db = new Connection();
    }

    public function getWallIdByUserName($userName){
        $query = "SELECT id_muro FROM MURO INNER JOIN USUARIO ON
                        MURO.id_usuario = USUARIO.id_usuario
                        WHERE USUARIO.nombre_usuario = '$userName'";
        $results = $this -> db -> query($query)
        or die('Error obteniendo el muro del usuario: ' . mysqli_error($this->db));
        $obj = $results -> fetch_object();
        return $obj -> id_muro;
    }

    public function getWallIdById($id){
        $query = "SELECT id_muro FROM MURO INNER JOIN USUARIO ON
                        MURO.id_usuario = USUARIO.id_usuario
                        WHERE USUARIO.id_usuario = '$id'";

        $results = $this -> db -> query($query)
        or die('Error obteniendo el muro del usuario: ' . mysqli_error($this->db));
	
		$obj = $results -> fetch_object();
		
        return $obj -> id_muro;
    }

    public function createWall($userId){
        $query1 = "INSERT INTO MURO (id_usuario, privacidad)
                  VALUES ($userId, 'publico')";
        $results1 = $this -> db -> query($query1)
        or die('Error insertando el muro: ' . mysqli_error($this->db));

        $lastID = $this -> db -> insert_id;
        $query2 = "INSERT INTO MENSAJE (id_usuario,id_muro,contenido)
                  VALUES ($userId,$lastID,'Bienvenido a The Wall')";

        $results2 = $this -> db -> query($query2)
        or die('Error insertando el mensaje: ' . mysqli_error($this->db));

    }

    public function getPrivacityById($wallId){
        $wallId = (int) $wallId;
        $query = "SELECT privacidad FROM MURO WHERE id_muro = $wallId";

        $results = $this -> db -> query($query)
        or die('Error obteniendo la privacidad del muro: ' . mysqli_error($this->db));

        $obj = $results -> fetch_object();

        return $obj -> privacidad;
    }

    public function getUsersById($wallId){
        $query = "SELECT nombre_usuario FROM COMPARTE_CON INNER JOIN USUARIO
          ON COMPARTE_CON.id_usuario = USUARIO.id_usuario WHERE id_muro = $wallId";

        $results = $this -> db -> query($query)
        or die('Error obteniendo los usuarios de comparte_con: ' . mysqli_error($this->db));

        $obj = Array();
        while ($row = $results->fetch_object()) {
            $obj[] = $row;
        }

        return $obj;
    }

    public function updatePrivacity($data){

        $wallId = $data['wallId'];
        $privacity = $data['privacity'];

        if($privacity == "opt-1") {
            $users = $data['users'];

            foreach($users as $userId){
                $wallId = (int) $wallId;
                $userId = (int) $userId;

                //arreglar query para que no inserte duplicados
                $querySelect = "SELECT id_usuario FROM COMPARTE_CON WHERE id_muro = $wallId and id_usuario = $userId";

                $resultsSelect = $this -> db -> query($querySelect)
                or die('Error consultando los usuarios del muro: ' . mysqli_error($this->db));

                if($resultsSelect->num_rows == 0)
                {
                    $queryInsert = "INSERT INTO COMPARTE_CON (id_muro, id_usuario)
                          VALUES($wallId,$userId)";

                    $results = $this -> db -> query($queryInsert)
                    or die('Error insertando los usuarios con COMPARTE_CON: ' . mysqli_error($this->db));
                };


            }
            $queryUpdate = "UPDATE MURO SET privacidad = 'privado' WHERE id_muro = $wallId";

        }else if($privacity == "opt-2"){
            $users = $data['users'];

            foreach($users as $userId){
                $wallId = (int) $wallId;
                $userId = (int) $userId;

                $query = "INSERT INTO COMPARTE_CON (id_muro, id_usuario)
                          VALUES($wallId,$userId)";

                $results = $this -> db -> query($query)
                or die('Error insertando los usuarios con COMPARTE_CON: ' . mysqli_error($this->db));
            }
            $queryUpdate = "UPDATE MURO SET privacidad = 'privado' WHERE id_muro = $wallId";
        }else{
            $queryUpdate = "UPDATE MURO SET privacidad = 'publico' WHERE id_muro = $wallId";
        };


        $resultsUpdate = $this -> db -> query($queryUpdate)
        or die('Error actualizando la privacidad del muro: ' . mysqli_error($this->db));

    }

    public function removeUser($userId, $wallId){

        $query = "DELETE FROM COMPARTE_CON WHERE id_usuario = $userId and id_muro = $wallId";

        $results = $this -> db -> query($query)
        or die('Error obteniendo el muro del usuario: ' . mysqli_error($this->db));

        return $results;
    }

    public function __destruct(){
        $this -> db -> close();
    }
}