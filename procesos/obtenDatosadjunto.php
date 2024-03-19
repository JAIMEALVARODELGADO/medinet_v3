<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudadjunto.php";

	$obj=new crudadjunto();
	echo json_encode($obj->obtenDatos($_POST['idadj']));

?>