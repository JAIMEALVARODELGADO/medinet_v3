<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudcita.php";
	$obj=new crudcita();
	echo json_encode($obj->obtenDatos($_POST['id_persona']))

?>