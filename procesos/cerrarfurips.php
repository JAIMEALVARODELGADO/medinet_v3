<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudfurips.php";

	$obj=new crudfurips();
	echo $obj->cerrar($_POST['idrec']);
?>