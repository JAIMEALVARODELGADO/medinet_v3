<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudconvenio.php";

	$obj=new crudconvenio();
	echo $obj->eliminar($_POST['idconv']);

?>