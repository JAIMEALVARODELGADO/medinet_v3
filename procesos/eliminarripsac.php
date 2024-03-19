<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudrips.php";

	$obj=new crudrips();
	echo $obj->eliminar($_POST['idripsac']);

?>