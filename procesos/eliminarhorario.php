<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudhorario.php";

	$obj=new crudhorario();
	echo $obj->eliminar($_POST['idagh']);

?>