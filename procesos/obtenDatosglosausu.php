<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudglosausu.php";

	$obj=new crudglosausu();
	echo json_encode($obj->obtenDatos($_POST['idconper']));

?>