<?php
require_once (dirname(__DIR__)."/connection/Connection.php");

class MuroRepositoryService{
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

    public function createWall($userId){
        $query = "INSERT INTO MURO (id_usuario, privacidad)
                  VALUES ($userId, 'publico')";

        $results = $this -> db -> query($query)
        or die('Error insertando el muro: ' . mysqli_error($this->db));

        $obj = $results -> fetch_object();
    }

    public function updatePrivacity($data){

        $wallId = $data['wallId'];
        $privacity = $data['privacity'];

        if($privacity == "opt-1") {
            $users = $data['users'];

            foreach($users as $userId){
                $query = "INSERT INTO COMPARTE_CON (id_muro, id_usuario)
                      VALUES ($wallId, $userId)";

                $results = $this -> db -> query($query)
                or die('Error insertando los usuarios con COMPARTE_CON: ' . mysqli_error($this->db));
            }
            $queryUpdate = "UPDATE MURO SET privacidad = 'privado' WHERE id_wall = $wallId";

        }else if($privacity == "opt-2"){
            $users = $data['users'];

            foreach($users as $userId){
                $query = "INSERT INTO COMPARTE_CON (id_muro, id_usuario)
                          VALUES ($wallId, $userId)";

                $results = $this -> db -> query($query)
                or die('Error insertando los usuarios con COMPARTE_CON: ' . mysqli_error($this->db));
            }
            $queryUpdate = "UPDATE MURO SET privacidad = 'privado' WHERE id_wall = $wallId";
        }else{
            $queryUpdate = "UPDATE MURO SET privacidad = 'publico' WHERE id_wall = $wallId";
        };


        $results = $this -> db -> query($queryUpdate)
        or die('Error actualizando la privacidad del muro: ' . mysqli_error($this->db));

        $obj = $results -> fetch_object();

        return $obj -> id_muro;

    }

    public function __destruct(){
        $this -> db -> close();
    }
}