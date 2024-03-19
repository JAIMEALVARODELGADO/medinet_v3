<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudprocedimiento.php";

	$obj=new crudprocedimiento();
	echo $obj->eliminar($_POST['idproc']);

?>