<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudfurips.php";

	$obj=new crudfurips();
	echo json_encode($obj->obtenDatosfurips($_POST['idreclamacion']));

?>