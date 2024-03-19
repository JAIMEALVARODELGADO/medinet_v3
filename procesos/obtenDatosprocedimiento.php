<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudprocedimiento.php";

	$obj=new crudprocedimiento();
	echo json_encode($obj->obtenDatos($_POST['idproc']));

?>