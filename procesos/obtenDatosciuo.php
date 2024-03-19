<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudciuo.php";

	$obj=new crudciuo();
	echo json_encode($obj->obtenDatos($_POST['idciuo']));

?>