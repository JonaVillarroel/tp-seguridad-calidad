<?php
require_once (dirname(__DIR__)."/connection/Connection.php");

//Todas las querys que se hagan sobre la tabla USUARIO, ACÁÁÁÁÁÁÁÁ.


class UserRepositoryService{
    var $db;

    function __construct(){
        $this -> db = new Connection();
    }


    function getAllUsers(){
        $query = "SELECT * FROM USUARIO where fecha_baja = null";

        $results = $this -> db -> query($query)
        or die('Error obteniendo todos los usuarios: ' . mysqli_error($this->db));

    }
}

?>