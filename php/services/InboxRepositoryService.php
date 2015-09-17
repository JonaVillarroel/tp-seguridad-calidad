<?php
require_once (dirname(__DIR__)."/connection/Connection.php");

class InboxRepositoryService
{
    var $db;

    public function __construct(){
        $this -> db = new Connection();
    }

    function getConversationsByUserId($userId){
        $query = "SELECT MP1.*, USUARIO.id_usuario as prop_id_bandeja, USUARIO.nombre as prop_nombre_bandeja,
                    USUARIO.apellido as prop_apellido_bandeja
                    FROM MENSAJE_PRIVADO as MP1 INNER JOIN
                    (BANDEJA_DE_ENTRADA INNER JOIN USUARIO ON
                    BANDEJA_DE_ENTRADA.id_usuario = USUARIO.id_usuario)
                    ON BANDEJA_DE_ENTRADA.id_bandeja = MP1.id_bandeja
                    WHERE (MP1.id_usuario = 9 or MP1.id_bandeja = 9) and (MP1.fecha_alta IN (
                    SELECT max(MP2.fecha_alta) as maximo FROM MENSAJE_PRIVADO as MP2
                    WHERE (MP2.id_usuario = 9) or (MP2.id_bandeja = 9)
                    GROUP BY MP2.id_usuario, MP2.id_bandeja
                    ) );

";
        $results = $this -> db -> query($query)
        or die('Error obteniendo las conversaciones del inbox: ' . mysqli_error($this->db));

        return $results;
    }

    function getMessagesOfChat($userRemitentIdFirst, $inboxIdFirst, $userRemitentIdSecond, $inboxIdSecond){
        $query = "SELECT MENSAJE_PRIVADO.*, USUARIO.nombre, USUARIO.apellido FROM MENSAJE_PRIVADO INNER JOIN USUARIO ON
                  MENSAJE_PRIVADO.id_usuario = USUARIO.id_usuario
                  WHERE (MENSAJE_PRIVADO.id_usuario = $userRemitentIdFirst and id_bandeja = $inboxIdSecond) or (MENSAJE_PRIVADO.id_usuario = $userRemitentIdSecond and id_bandeja = $inboxIdFirst)
                  ORDER BY MENSAJE_PRIVADO.fecha_alta";
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