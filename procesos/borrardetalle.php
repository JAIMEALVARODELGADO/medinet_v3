<?php
	require_once "../clases/conexion.php";
	require_once "../clases/cruddetalle.php";

	$obj=new cruddetalle();
	echo $obj->eliminar($_POST['iddet']);

?>