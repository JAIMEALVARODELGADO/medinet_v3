<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudmedicamento.php";

	$obj=new crudmedicamento();
	echo json_encode($obj->obtenDatos($_POST['idmed']));

?>