<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudexamen.php";

	$obj=new crudexamen();
	echo json_encode($obj->obtenDatos($_POST['idmef']));

?>