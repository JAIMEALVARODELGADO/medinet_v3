<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudexamen.php";

	$obj=new crudexamen();
	echo $obj->eliminar($_POST['idmef']);

?>