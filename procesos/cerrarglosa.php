<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudglosas.php";

	$obj=new crudglosas();
	echo $obj->cerrar($_POST['idglosa']);

?>