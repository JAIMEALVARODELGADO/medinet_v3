<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudglosausu.php";

	$obj=new crudglosausu();
	echo $obj->eliminar($_POST['idconper']);

?>