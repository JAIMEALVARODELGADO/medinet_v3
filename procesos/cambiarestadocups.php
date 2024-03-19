<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudcups.php";

	$obj=new crudcups();
	echo $obj->cambiarestado($_POST['idcups']);

?>