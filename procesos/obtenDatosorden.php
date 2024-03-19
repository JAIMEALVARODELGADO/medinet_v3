<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudorden.php";

	$obj=new crudorden();
	echo json_encode($obj->obtenDatos($_POST['iddet']));

?>