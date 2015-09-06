<?php
require_once (dirname(__DIR__)."/services/WallRepositoryService.php");

$wallRepo = new WallRepositoryService();

$userId = $_POST['userId'];
$privacity = $_POST['privacity'];


?>