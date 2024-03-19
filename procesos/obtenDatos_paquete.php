<?php
	require_once "../clases/conexion.php";
	require_once "../clases/cruddetalle_paquete.php";
	$obj=new cruddetalle_paquete();
	echo json_encode($obj->obtenDatos($_POST['idmedpq']));
?>