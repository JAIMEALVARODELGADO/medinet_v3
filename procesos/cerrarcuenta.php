<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudcuentacobro.php";

	$obj=new crudcuentacobro();
	echo $obj->cerrar($_POST['idccob']);

?>