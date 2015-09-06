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

    public function __destruct(){
        $this -> db -> close();
    }
}