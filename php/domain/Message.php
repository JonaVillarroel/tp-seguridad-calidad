<?php

require_once (dirname(__DIR__)."/connection/Connection.php");

class Message extends Connection{
    private $content;
    private $toWall;
    private $fromUser;
    //private $toUser;
    private $dateLeaving;
    private $dateStart;

    /**
     * Message constructor.
     * @param $content
     * @param $toWall
     * @param $fromUser
     */
    public function __construct($content, $toWall, $fromUser)
    {
        $this->content = $content;
        $this->toWall = $toWall;
        $this->fromUser = $fromUser;
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $this->dateStart = date('Y-m-d H:i:s');

        self::save();

    }

    private function save(){
        $db = new Connection();

        $fromUser = $this -> fromUser;
        $toWall = $this -> toWall;
        $content = $this -> content;
        $dateStart = $this -> dateStart;

        $query = "INSERT INTO MENSAJE(id_usuario, id_muro, contenido, fecha_alta)
        VALUES ('$fromUser','$toWall','$content','$dateStart')";

        $results = $db -> query($query)
        or die('Error guardando el mensaje: ' . 'del Usuario: ' . $fromUser . 'Para muro: ' . $toWall . 'Contenido: '. $content . 'Fecha: ' . $dateStart . ' /// ' . mysqli_error($db));
	
		$db -> close();
    }


    public function remove($id_mensaje){
        $db = new Connection();
        $dateLeaving = date("m.d.y");

        $query = "UPDATE MENSAJE SET fecha_baja = $dateLeaving where id_mensaje = $id_mensaje";

        $results = $db -> query($query)
        or die('Error dando de baja el mensaje: ' . mysqli_error($this->db));
		
		$db -> close();
    }

    public function getContent(){
        return content;
    }
}

?>