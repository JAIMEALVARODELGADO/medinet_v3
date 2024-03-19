<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudconciliacion.php";

	$obj=new crudconciliacion();
	echo json_encode($obj->obtenDatos($_POST['idconcil']));
?>