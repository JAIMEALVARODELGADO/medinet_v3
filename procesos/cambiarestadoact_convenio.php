<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudact_convenio.php";

	$obj=new crudact_convenio();
	echo $obj->cambiarestado($_POST['idcdet']);

?>