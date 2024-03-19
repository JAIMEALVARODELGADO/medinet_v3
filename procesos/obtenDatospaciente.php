<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudpersona.php";

	$obj=new crudpersona();
	echo json_encode($obj->obtenDatospaciente($_POST['idpersona']));

?>