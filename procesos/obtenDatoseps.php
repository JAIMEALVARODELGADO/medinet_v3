<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudeps.php";

	$obj=new crudeps();
	echo json_encode($obj->obtenDatos($_POST['ideps']));

?>