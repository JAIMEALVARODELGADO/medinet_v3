<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudmedicameformula.php";

	$obj=new crudmedicameformula();
	echo $obj->eliminar($_POST['iddet']);

?>