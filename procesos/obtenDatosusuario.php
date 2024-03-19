<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudusuario.php";

	$obj=new crudusuario();
	echo json_encode($obj->obtenDatos($_POST['idusu']));

?>