<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudabono.php";

	$obj=new crudabono();
	echo json_encode($obj->obtenDatos($_POST['idabono']));
?>