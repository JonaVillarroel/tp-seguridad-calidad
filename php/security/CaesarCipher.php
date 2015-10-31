<?php

class CaesarCipher
{
    private $message;
    private $sizeMessage;

    public function __construct($message)
    {
        $this->message = $message;
        $this->sizeMessage = strlen($message);
    }


    public function encryptMessage(){
        $encryptedMessage = "";

        for($i = 0; $i < $this->sizeMessage; $i++){
            $encryptedMessage.= chr((ord($this->message[$i])+3)%255);
        }

        return $encryptedMessage;
    }

    public function decryptMessage(){
        $decryptedMessage = "";

        for($i = 0; $i < $this->sizeMessage; $i++){
            $decryptedMessage.= chr((ord($this->message[$i])-3 + 255)%255);
        }

        return $decryptedMessage;
    }


}