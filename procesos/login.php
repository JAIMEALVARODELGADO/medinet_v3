<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudlogin.php";

	$obj=new crudlogin();
	echo json_encode($obj->obtenDatos($_POST['usuario'],sha1($_POST['password'])));

?>