<?php
require_once (dirname(__DIR__)."/connection/Connection.php");

class InboxRepositoryService
{
    var $db;

    public function __construct(){
        $this -> db = new Connection();
    }

    function getConversationsByUserId($userId, $inboxUserId){
        $query = "SELECT *
                    FROM (SELECT MP2.*, US.id_usuario as prop_id_bandeja, US.nombre as prop_nombre_bandeja,
                                        US.apellido as prop_apellido_bandeja
                     FROM MENSAJE_PRIVADO as MP2
                    INNER JOIN
                        (BANDEJA_DE_ENTRADA as BDJ INNER JOIN USUARIO as US ON
                        BDJ.id_usuario = US.id_usuario)
                    ON MP2.id_bandeja = BDJ.id_bandeja

                    WHERE (MP2.id_usuario = $userId) or (MP2.id_bandeja = $inboxUserId)
                    ORDER BY fecha_alta DESC) x
                    GROUP BY id_conversacion
                    ORDER BY fecha_alta DESC";
        $results = $this -> db -> query($query)
        or die('Error obteniendo las conversaciones del inbox: ' . mysqli_error($this->db));

        return $results;
    }

    function getConversationToUser($userId, $conversationId){
        $query = "select MENSAJE_PRIVADO.*, USUARIO.id_usuario as prop_id_bandeja, USUARIO.nombre as prop_nombre_bandeja,
                    USUARIO.apellido as prop_apellido_bandeja
                    from MENSAJE_PRIVADO INNER JOIN USUARIO ON MENSAJE_PRIVADO.id_usuario = USUARIO.id_usuario
                    where MENSAJE_PRIVADO.id_conversacion = $conversationId and MENSAJE_PRIVADO.id_usuario != $userId";
        $results = $this -> db -> query($query)
        or die('Error obteniendo las conversaciones del chat: ' . mysqli_error($this->db));

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
        $query = "SELECT BANDEJA_DE_ENTRADA.id_usuario FROM BANDEJA_DE_ENTRADA INNER JOIN USUARIO
                  ON BANDEJA_DE_ENTRADA.id_usuario = USUARIO.id_usuario
                  WHERE USUARIO.id_usuario = $userId";

        $results = $this -> db -> query($query)
        or die('Error obteniendo la bandeja de entrada del usuario por id de usuario: ' . mysqli_error($this->db));

        $obj = $results -> fetch_object();

        return $obj -> id_usuario;
    }

    function getInboxIdAndLeaveDateByUserId($userId){
        $query = "SELECT BANDEJA_DE_ENTRADA.id_usuario, USUARIO.fecha_baja FROM BANDEJA_DE_ENTRADA INNER JOIN USUARIO
                  ON BANDEJA_DE_ENTRADA.id_usuario = USUARIO.id_usuario
                  WHERE USUARIO.id_usuario = $userId";

        $results = $this -> db -> query($query)
        or die('Error obteniendo la bandeja de entrada del usuario por id de usuario: ' . mysqli_error($this->db));

        return $results;
    }

    public function createInbox($userId){
        $query = "INSERT INTO BANDEJA_DE_ENTRADA (id_usuario)
                  VALUES ($userId)";
        $results = $this -> db -> query($query)
        or die('Error creando la bandeja de entrada: ' . mysqli_error($this->db));

        return $results;

    }

    function postMessage($inboxId, $userIdSender, $content, $conversationId){
        $conversationId = (int)$conversationId;
        $query = "INSERT INTO MENSAJE_PRIVADO (id_usuario,id_bandeja,contenido,fecha_alta, id_conversacion)
                  VALUES ($userIdSender, $inboxId, '$content', NOW(), $conversationId)";

        $results = $this -> db -> query($query)
        or die('Error insertando el mensaje en la BD: ' . mysqli_error($this->db));

        return $results;
    }

    function getLastConversationId(){
        $query = "SELECT max(id_conversacion) as conver_max  FROM MENSAJE_PRIVADO";

        $results = $this -> db -> query($query)
        or die('Error obteniendo la conversacion: ' . mysqli_error($this->db));

        $obj = $results -> fetch_object();

        return $obj -> conver_max;
    }

    function getConversationIdByInboxId($recipientInboxId, $userIdSender, $senderInboxId, $toUser){
        $query = "SELECT id_conversacion FROM MENSAJE_PRIVADO
                  WHERE (id_bandeja = $recipientInboxId and id_usuario = $userIdSender) or (id_bandeja = $senderInboxId and id_usuario = $toUser)
                  LIMIT 1";

        $results = $this -> db -> query($query)
        or die('Error obteniendo la conversacion: ' . mysqli_error($this->db));

        if($results -> num_rows == 0){
            return null;
        }else{
            $obj = $results -> fetch_object();

            return $obj -> id_conversacion;
        };
    }

        // Modifica el límite de mensajes
    public function modifyLimitInbox($userId, $limite){
        $myConnection = new Connection();
        
        //verifico que sea un número positivo
        if(is_numeric($limite)) {
            if($limite >= 0){
                $result = $myConnection -> query("UPDATE BANDEJA_DE_ENTRADA SET BANDEJA_DE_ENTRADA.limite = '$limite' WHERE BANDEJA_DE_ENTRADA.id_usuario = '$userId';");
            }
        }
        else {
             $errorMessageView = "El número ingresado no es válido<br>";
        }
        
        $myConnection -> close();
        
        header ('location: ../../indexAdmin.php?list=current');
    }


    public function __destruct(){
        $this -> db -> close();
    }
}