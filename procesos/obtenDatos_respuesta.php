<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crud_respuestaglo.php";

	$obj=new crud_respuestaglo();
	echo json_encode($obj->obtenDatos($_POST['idresp']));

?>