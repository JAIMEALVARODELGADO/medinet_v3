<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudcie.php";

	$obj=new crudcie();
	echo $obj->cambiarestado($_POST['idcie']);

?>