<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudorden.php";

	$obj=new crudorden();
	echo $obj->eliminardetalle($_POST['iddet']);

?>