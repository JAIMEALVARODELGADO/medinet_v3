<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudcupsprof.php";

	$obj=new crudcupsprof();
	echo json_encode($obj->obtenDatos($_POST['idcupsprof']));

?>