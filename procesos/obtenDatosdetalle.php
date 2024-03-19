<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudmedicameformula.php";

	$obj=new crudmedicameformula();
	echo json_encode($obj->obtenDatos($_POST['iddet']));

?>