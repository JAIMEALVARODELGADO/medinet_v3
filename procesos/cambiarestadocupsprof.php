<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudcupsprof.php";

	$obj=new crudcupsprof();
	echo $obj->cambiarestado($_POST['idcupsprof']);

?>