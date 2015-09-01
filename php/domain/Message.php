<?php
include_once (dirname(__DIR__)."/connection/Querybuilder.php");

class Message{
    private $content;
    private $toWall;
    private $fromUser;
    //private $toUser;
    private $date_leaving;
    private $date_start;

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
        $this->date_start = new Date();

        self::save();

    }

    private function save(){

        $values['contenido'] = $this -> content;
        $values['id_usuario'] = $this -> fromUser;
        $values['id_muro'] = $this -> toWall;
        $values['fecha_alta'] = $this -> date_start;

        $queryBuilder = new Querybuilder();
        $queryBuilder.insert('MENSAJE', $values);
    }


}

?>