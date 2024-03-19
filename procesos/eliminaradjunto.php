<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudadjunto.php";

	$obj=new crudadjunto();
	echo $obj->eliminar($_POST['idadj']);

?>