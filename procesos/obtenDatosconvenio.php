<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudconvenio.php";

	$obj=new crudconvenio();
	echo json_encode($obj->obtenDatos($_POST['idconv']));

?>