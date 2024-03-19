<?php
	require_once "../clases/conexion.php";
	require_once "../clases/cruddetalle.php";

	$obj=new cruddetalle();
	echo json_encode($obj->obtenDatos($_POST['iddet']));

?>