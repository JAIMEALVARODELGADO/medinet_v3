<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudconciliacion.php";

	$obj=new crudconciliacion();
	echo $obj->cerrar($_POST['idconcil']);

?>