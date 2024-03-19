<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudcuentacobro.php";

	$obj=new crudcuentacobro();
	echo json_encode($obj->obtenDatos($_POST['idccob']));

?>