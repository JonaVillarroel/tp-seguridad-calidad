<?php
	require_once(dirname(__DIR__)."/services/InboxRepositoryService.php");
	require_once (dirname(__DIR__)."/domain/Wall.php");
	//SETTEA EL LIMITE DE LA CANTIDAD MAXIMA DE MENSAJES

	//BANDEJA_DE_ENTRADA (Mensajes Privados)
	if(isset($_POST ["MsjPrivLimit"])){
		$limite1 = $_POST ["MsjPrivLimit"];

		$inbox = new InboxRepositoryService();
		$inbox -> modifyLimitInbox($limite1);
	}

	//MURO (Mensajes Publicos)
	if(isset($_POST ["MsjPublicLimit"])){
		$limite2 = $_POST ["MsjPublicLimit"];

		$wall = new Wall();
		$wall -> modifyLimitAllWall($limite2);
	}
	
?>