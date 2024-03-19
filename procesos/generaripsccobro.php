<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudrips.php";
	//echo $_POST['id_ccobro'];
	$obj=new crudrips();
	echo $obj->generarrips($_POST['id_ccobro']);

?>