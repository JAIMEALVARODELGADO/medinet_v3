<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudeps.php";

	$obj=new crudeps();
	echo $obj->eliminar($_POST['ideps']);

?>