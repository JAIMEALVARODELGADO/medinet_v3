<?php
	require_once "../clases/conexion.php";
	require_once "../clases/cruddetalleef.php";

	$obj=new cruddetalleef();
	echo $obj->eliminar($_POST['iddef']);

?>