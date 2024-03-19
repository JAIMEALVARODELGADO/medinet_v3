<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudcie.php";

	$obj=new crudcie();
	echo json_encode($obj->obtenDatos($_POST['idcie']));

?>