<?php
// Array with names
      
  require "./php/domain/User.php";
  $user = new User();
  $result = $user -> getUsersStatusCurrent();

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    while($row = $result -> fetch_object()){
        $conte = $row->nombre_usuario . " - " . $row->mail;
        //if (stristr($q, substr($row->nombre_usuario, 0, $len))) {con esta línea busca desde el inicio de la cadena
        if (stristr($conte,$q)) {
            if ($hint === "") {
                $hint = "<a href='http://localhost/tp-seguridad-calidad/index.php?usuario=".$row->id_usuario."'>" . $conte . "</a>";
            } else {
                $hint .= "<br /> <a href='http://localhost/tp-seguridad-calidad/index.php?usuario=".$row->id_usuario."'>" . $conte ."</a>";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no hay resultados" : $hint;

?>

