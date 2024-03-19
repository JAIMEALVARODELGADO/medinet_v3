<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudmedicamento.php";

	$obj=new crudmedicamento();
	echo $obj->cambiarestado($_POST['idmed']);

?>