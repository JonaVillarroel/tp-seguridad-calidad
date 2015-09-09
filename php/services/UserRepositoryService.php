<?php
require_once (dirname(__DIR__)."/connection/Connection.php");

//Todas las querys que se hagan sobre la tabla USUARIO, ACÁÁÁÁÁÁÁÁ.


class UserRepositoryService{
    var $db;

    public function __construct(){
        $this -> db = new Connection();
    }

    public function getUsers(){
        $query = "SELECT * FROM USUARIO where fecha_baja = null";

        $results = $this -> db -> query($query)
        or die('Error obteniendo todos los usuarios: ' . mysqli_error($this->db));

    }

    public function getWallIdById($userId){
        $query = "SELECT id_muro FROM MURO INNER JOIN USUARIO
                  ON USUARIO.id_usuario = MURO.id_usuario where USUARIO.fecha_baja is null and MURO.id_usuario = '$userId'";

        $results = $this -> db -> query($query)
        or die('Error obteniendo el id_muro: ' . mysqli_error($this->db));

        $obj = $results -> fetch_object();

        return $obj -> id_muro;
    }

    public function getUserById($userId){
        $query = "SELECT * FROM USUARIO where fecha_baja = null and id_usuario = $userId";

        $results = $this -> db -> query($query)
        or die('Error obteniendo el usuario: ' . mysqli_error($this->db));
    }


    public function getUserIdByName($userName){
        $query = "SELECT id_usuario FROM USUARIO where fecha_baja is null and nombre_usuario = '$userName'";

        $results = $this -> db -> query($query)
        or die('Error obteniendo el usuario: ' . mysqli_error($this->db));

        $obj = $results -> fetch_object();

        echo $obj -> id_usuario;
        return $obj -> id_usuario;
    }

    public function verifyUser($userName){
        $query = "SELECT id_usuario FROM USUARIO where fecha_baja is null and nombre_usuario = '$userName'";

        $results = $this -> db -> query($query)
        or die('Error obteniendo el usuario: ' . mysqli_error($this->db));

        if($results -> num_rows === 0)
        {
            return null;
        }else{
            $obj = $results -> fetch_object();

            return $obj -> id_usuario;
        };
    }

    public function __destruct(){
        $this -> db -> close();
    }


}

?>