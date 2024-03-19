<?php
require_once "../clases/conexion.php";
require_once "../clases/crudexamen.php";
$obj=new crudexamen();

$datos=array($_POST['id_mef'],
	$_POST['descripcion_mefU']);

echo $obj->actualizar($datos);

?>