<?php
require_once "../clases/conexion.php";
require_once "../clases/cruddetalle.php";
$obj=new cruddetalle();

$datos=array($_POST['id_detfac'],
	$_POST['id_cdetU'],
	$_POST['cantidad_detfacU'],
	$_POST['valor_unit_detfacU']);

echo $obj->actualizar($datos);

?>