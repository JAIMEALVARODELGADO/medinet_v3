<?php
	require_once "../clases/conexion.php";
	require_once "../clases/cruddetalleef.php";

	$obj=new cruddetalleef();
	echo json_encode($obj->obtenDatos($_POST['iddef']));
?>