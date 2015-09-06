
<?php
mysqli_report(MYSQLI_REPORT_STRICT);
header("Access-Control-Allow-Origin: *");
 header('Content-Type: text/html; charset=utf-8');

include_once ("php/connection/Connection.php");

	 class Consulta extends Connection {

    public function __construct()
    {
        parent::__construct();
    }

     function showRegisteredUsers(){

		//$queryBuilder = new Querybuilder();
    	//$queryBuilder=null;
    	$mibd = new Connection();

    	 $query = "SELECT * FROM USUARIO where estado='Registrado' ";
        $result = $this->mibd->query($query) or die( "Error en el SELECT: ".mysqli_error($this->mibd) );

    	//$result = $queryBuilder->select('USUARIO','*',null,null,null,null);
    	//$result = $this->mibd->query($queryBuilder);
    		//or die('Error: ' . mysqli_error($this->mibd));
    	
		if ($result = $mibd->query($query)) {
		while( $object = $result->fetch_object() ){

			echo

			"<tr id='".$object->id_usuario."'>

				<td>
					".$object->id_usuario."
				</td>

				<td>
					".$object->rol."
				</td>


				<td>
					".$object->nombre."
				</td>
				

				<td>
					".$object->apellido."
				</td>

				<td>
					".$object->mail."
				</td>

				<td>
					".$object->nombre_usuario."
				</td>

				<td>
					".$object->estado."
				</td>

				<td>
				</td>

			
				</tr>";
		}


    
}
else{
			echo" No hay solicitudes pendientes de revisión";
	}
	$result->close();
}
    

     function showRequestList(){

		$mibd = new Connection();
    
    	 $query = "SELECT * FROM USUARIO where estado='Pendiente' ";
        $result = $this->mibd->query($query) or die( "Error en el SELECT: ".mysqli_error($this->mibd) );

    	
		if ($result = $mibd->query($query)) {
		while( $object = $result->fetch_object() ){

			echo

			"<tr id='".$object->id_usuario."'>

				<td>
					".$object->id_usuario."
				</td>

				<td>
					".$object->rol."
				</td>


				<td>
					".$object->nombre."
				</td>
				

				<td>
					".$object->apellido."
				</td>

				<td>
					".$object->mail."
				</td>

				<td>
					".$object->nombre_usuario."
				</td>

				<td>
                     

					".$object->estado."
				</td>
				<td>
				<input type=checkbox>
				<td>

			
				</tr>";
		}

 
}else{
			echo" No hay usuarios registrados";
	}
	$result->close();
	}


}
?>