<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudcups.php";

	$obj=new crudcups();
	echo json_encode($obj->obtenDatos($_POST['idcups']));

?>