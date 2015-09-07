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

    public function getUserById($userId){
        $query = "SELECT * FROM USUARIO where fecha_baja = null and id_usuario = $userId";

        $results = $this -> db -> query($query)
        or die('Error obteniendo el usuario: ' . mysqli_error($this->db));
    }


    public function getUserIdByName($userName){
        $query = "SELECT id_usuario FROM USUARIO where fecha_baja = null and nombre_usuario = '$userName'";

        $results = $this -> db -> query($query)
        or die('Error obteniendo el usuario: ' . mysqli_error($this->db));

        $obj = $results -> fetch_object();

        return $obj -> id_usuario;
    }

    public function __destruct(){
        $this -> db -> close();
    }

}

?>