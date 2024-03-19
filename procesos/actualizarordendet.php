<?php
require_once "../clases/conexion.php";
require_once "../clases/crudorden.php";
$obj=new crudorden();

$datos=array($_POST['id_ord_det'],
	$_POST['id_cupsU'],
	$_POST['observacion_detU']
);

echo $obj->actualizardet($datos);

?>