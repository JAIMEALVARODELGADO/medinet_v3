<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudfactura.php";

	$obj=new crudfactura();
	echo $obj->anular($_POST['idfac']);

?>