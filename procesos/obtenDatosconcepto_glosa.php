<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudconcepto_glosa.php";

	$obj=new crudconcepto_glosa();
	echo json_encode($obj->obtenDatos($_POST['id_conglo']));

?>