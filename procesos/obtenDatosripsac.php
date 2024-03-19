<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudrips.php";
	
	$obj=new crudrips();	
	echo json_encode($obj->obtenDatos($_POST['idripsac']));
?>