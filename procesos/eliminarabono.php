<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudabono.php";

	$obj=new crudabono();
	echo $obj->eliminar($_POST['idabono']);

?>