<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudglosas.php";

	$obj=new crudglosas();
	echo json_encode($obj->obtenDatos($_POST['idglosa']));

?>