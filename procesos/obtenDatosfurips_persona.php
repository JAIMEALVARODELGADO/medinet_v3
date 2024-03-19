<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudfurips_persona.php";

	$obj=new crudfurips_persona();
	echo json_encode($obj->obtenDatos($_POST['idpersona']));

?>