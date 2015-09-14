<?php
require_once (dirname(__DIR__)."/connection/Connection.php");

class InboxRepositoryService
{
    var $db;

    public function __construct(){
        $this -> db = new Connection();
    }

    function getMessages($inboxId){

    }

    public function createInbox($userId){
        $query = "INSERT INTO BANDEJA_DE_ENTRADA (id_usuario)
                  VALUES ($userId)";
        $results = $this -> db -> query($query)
        or die('Error creando la bandeja de entrada: ' . mysqli_error($this->db));

        return $results;

    }

    function postMessage($inboxId, $userIdSender, $content){
        $query = "INSERT INTO MENSAJE_PRIVADO (id_usuario,id_bandeja,contenido,fecha_alta)
                  VALUES ($userIdSender, $inboxId, $content, NOW())";

        $results = $this -> db -> query($query)
        or die('Error insertando el mensaje en la BD: ' . mysqli_error($this->db));

        return $results;
    }

    public function __destruct(){
        $this -> db -> close();
    }
}