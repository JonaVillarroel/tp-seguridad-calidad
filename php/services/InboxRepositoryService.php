<?php
require_once (dirname(__DIR__)."/connection/Connection.php");

class InboxRepositoryService
{
    var $db;

    public function __construct(){
        $this -> db = new Connection();
    }

    function getMessagesOfChat($userRemitentId, $userRecipientId){
        $query = "SELECT MENSAJE_PRIVADO.*, USUARIO.nombre, USUARIO.apellido FROM MENSAJE_PRIVADO INNER JOIN USUARIO ON
                  MENSAJE_PRIVADO.id_usuario = USUARIO.id_usuario
                  WHERE id_usuario";
        $results = $this -> db -> query($query)
        or die('Error obteniendo los mensajes del chat: ' . mysqli_error($this->db));

        return $results;
    }

    function getInboxIdByUserName($userName){
        $query = "SELECT USUARIO.id_usuario FROM BANDEJA_DE_ENTRADA INNER JOIN USUARIO
                  ON BANDEJA_DE_ENTRADA.id_usuario = USUARIO.id_usuario
                  WHERE USUARIO.nombre_usuario = '$userName'";

        $results = $this -> db -> query($query)
        or die('Error obteniendo la bandeja de entrada del usuario por nombre de usuario: ' . mysqli_error($this->db));

        $obj = $results -> fetch_object();

        return $obj -> id_usuario;
    }

    function getInboxIdByUserId($userId){
        $query = "SELECT USUARIO.id_usuario FROM BANDEJA_DE_ENTRADA INNER JOIN USUARIO
                  ON BANDEJA_DE_ENTRADA.id_usuario = USUARIO.id_usuario
                  WHERE USUARIO.id_usuario = $userId";

        $results = $this -> db -> query($query)
        or die('Error obteniendo la bandeja de entrada del usuario por id de usuario: ' . mysqli_error($this->db));

        $obj = $results -> fetch_object();

        return $obj -> id_usuario;
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
                  VALUES ($userIdSender, $inboxId, '$content', NOW())";

        $results = $this -> db -> query($query)
        or die('Error insertando el mensaje en la BD: ' . mysqli_error($this->db));

        return $results;
    }

    public function __destruct(){
        $this -> db -> close();
    }
}