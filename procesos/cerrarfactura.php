<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudfactura.php";

	$obj=new crudfactura();
	echo $obj->cerrar($_POST['idfac']);

?>