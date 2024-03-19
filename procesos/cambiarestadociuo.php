<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudciuo.php";

	$obj=new crudciuo();
	echo $obj->cambiarestado($_POST['idciuo']);

?>