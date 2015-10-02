<?php
require_once (dirname(__DIR__)."/services/WallRepositoryService.php");
require_once (dirname(__DIR__)."/services/UserRepositoryService.php");

$wallRepo = new WallRepositoryService();
$userRepo = new UserRepositoryService();


$userId = $_SESSION['id'];

$wallId = $userRepo -> getWallIdById($userId);
//$privacity = isset($_POST['change']) ? $_POST['change'] : $wallRepo -> getPrivacityById($wallId);

$privacity = $wallRepo -> getPrivacityById($wallId);

$checkedPrivate = "";
$checkedSemiPrivate= "";
$checkedNormal = "";
$checkedSemiPublic = "";
$checkedPublic = "";
$usersPrivate = null;
$usersSemiPrivate = null;

switch ($privacity){
    case 'privado': $checkedPrivate = "checked";
                    $usersPrivate = $wallRepo -> getUsersById($wallId);
    break;
    case 'semiprivado': $checkedSemiPrivate = "checked";
                        $usersSemiPrivate = $wallRepo -> getUsersById($wallId);
    break;
    case 'normal': $checkedNormal = "checked";
    break;
    case 'semipublico': $checkedSemiPublic = "checked";
    break;
    case 'publico': $checkedPublic = "checked";
    break;
}
        echo "<div class='radio wallconfiguration '><br/>
                <label><input type='radio' name='optradio' value='public' ".$checkedPublic.">Todos los usuarios pueden ver tu muro y pueden publicar en el.</label>
            </div>";

        echo "<div class='radio wallconfiguration '><br/>
                <label><input type='radio' name='optradio' value='semipublic' ".$checkedSemiPublic.">Todos los usuarios pueden ver tu muro y solo usuarios registrados pueden publicar en el.</label>
            </div>";

        echo "<div class='radio wallconfiguration '><br/>
                <label><input type='radio' name='optradio' value='normal' ".$checkedNormal.">Sólo los usuarios registrados pueden ver tu muro y publicar en el.</label>
            </div>";

        echo "<div class='radio wallconfiguration'><br/>
                <label><input type='radio' name='optradio' value='semiprivate' ".$checkedSemiPrivate.">Sólo los usuarios registrados pueden ver tu muro pero sólo aquellos enumerados pueden publicar.</label><br/>
                <div class='col-sm-6'>
                <br/>
                <input type='text' class='form-control' placeholder='Escribe un nombre' id='item-semiPrivate'>
                </div><br/>
                <a href='#' id='addItemList-semiPrivate' class='btn btn-success'>Agregar</a>
                <div class='col-sm-6'>
                    <ul class='list-group list-semiPrivate'>";
        if(sizeof($usersSemiPrivate) > 0)
        {
            foreach($users as $user){
                echo "<li class='list-group-item'>"
                    .$user -> nombre_usuario.
                    "<button type='button' class='btn btn-danger btn-sm pull-right removeItemList-1' id=''>
                    <span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></li>";
            }
        };
        echo "    </ul>
                </div>
                </div>";


echo "<div class='radio wallconfiguration'><br/>
                <label><input type='radio' name='optradio' value='private' ".$checkedPrivate.">Sólo los usuarios enumerados pueden ver tu muro y publicar en el.</label><br/>
                <div class='col-sm-6'>
                <br/>
                <input type='text' class='form-control' placeholder='Escribe un nombre' id='item-private'>
                </div><br/>
                <a href='#' id='addItemList-private' class='btn btn-success'>Agregar</a>
                <div class='col-sm-6'>
                    <ul class='list-group list-private'>";
        if(sizeof($usersPrivate) > 0)
        {
            foreach($users as $user){
                echo "<li class='list-group-item'>"
                    .$user -> nombre_usuario.
                    "<button type='button' class='btn btn-danger btn-sm pull-right removeItemList-1' id=''>
                    <span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></li>";
            }
        };
        echo "    </ul>
                </div>
                </div>";

echo "<div class='col-sm-3 clear wallconfiguration'>
        <select id='topeLimite' class='form-control'>";
$tope = 20;
for($i = $tope; $i >= 0; $i--){
    echo "<option value='".$i."'>".$i."</option>";
}
echo "</select> <span class='line'>Limite de mensajes en el muro.</span>
</div>";

   
?>