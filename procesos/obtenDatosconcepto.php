<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudconcepto.php";

	$obj=new crudconcepto();
	echo json_encode($obj->obtenDatos($_POST['idconcep']));

?>