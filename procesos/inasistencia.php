<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudconsulta.php";

	$obj=new crudconsulta();
	echo $obj->inasistencia($_POST['id_agc']);

?>