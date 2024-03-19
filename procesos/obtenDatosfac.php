<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudfactura.php";

	$obj=new crudfactura();
	echo json_encode($obj->obtenDatos($_POST['idfac']));

?>