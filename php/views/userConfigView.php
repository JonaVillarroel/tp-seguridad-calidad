<?php
require_once (dirname(__DIR__)."/services/WallRepositoryService.php");
require_once (dirname(__DIR__)."/services/UserRepositoryService.php");

$wallRepo = new WallRepositoryService();
$userRepo = new UserRepositoryService();


$userId = $_SESSION['id'];

$wallId = $userRepo -> getWallIdById($userId);
$privacity = isset($_POST['change']) ? $_POST['change'] : $wallRepo -> getPrivacityById($wallId);

if ($privacity == 'privado')
{
    $users = $wallRepo -> getUsersById($wallId);

    echo "<div class='radio wallconfiguration '><br/>
            <label><input type='radio' name='optradio' value='opt-2' >Todos los usuarios del sistema pueden acceder y publicar contenido</label>
        </div>";

    echo "<div class='radio wallconfiguration'><br/>
            <label><input type='radio' name='optradio' value='opt-1' checked='true' >Sólo pueden acceder usuarios enumerados</label><br/>
            <div class='col-sm-6'>
            <br/>
            <input type='text' class='form-control' placeholder='Escribe un nombre' id='item-opt-1'>
            </div><br/>
            <a href='#' id='addItemList-1' class='btn btn-success'>Agregar</a>
            <div class='col-sm-6'>
                <ul class='list-group list-1'>";
    if(sizeof($users) > 0)
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
}else{

   echo "<div class='radio wallconfiguration '>
                    <label><input type='radio' name='optradio' value='opt-3' checked='true' >Todos los usuarios del sistema pueden acceder y publicar contenido</label>
                </div>";

            echo "<div class='radio wallconfiguration'>
                    <label><input type='radio' name='optradio' value='opt-4'>Usuarios anonimos pueden leer contenido</label>
                    </div>";

            echo "<div class='radio wallconfiguration'>
            <label><input type='radio' name='optradio' value='opt-5'>Usuarios anonimos pueden leer y publicar contenido</label>
            </div>";
}

?>


<!--<div class="radio wallconfiguration">
    <label><input type="radio" name="optradio" value="opt-2">Pueden acceder todos los usuarios  pero solo agregar mensajes
        aquellos enumerados</label>
    <input type="text" placeholder="Escribe un nombre" id="item-opt-2">
    <a href="#" id="addItemList-2" class="btn btn-success">Agregar</a>
    <ul class="list-group list-2">
    </ul>
</div>-->

<!--
<div class="radio wallconfiguration">
    <label><input type="radio" name="optradio" value="opt-4">Usuarios anónimos pueden leer contenido.</label>
</div>

<div class="radio wallconfiguration">
    <label><input type="radio" name="optradio" value="opt-5">Usuarios anónimos pueden crear y leer contenido.</label>
</div>
-->