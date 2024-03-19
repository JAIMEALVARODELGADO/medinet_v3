<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudentidad.php";

	$obj=new crudentidad();
	echo json_encode($obj->obtenDatos($_POST['ident']));

?>