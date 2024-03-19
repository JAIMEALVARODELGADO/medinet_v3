<?php
require_once "../clases/conexion.php";
require_once "../clases/crudconciliacion.php";
$obj=new crudconciliacion();
$datos=array($_POST['id_conciliacion'],	
	$_POST['id_facturaU'],
	$_POST['fecha_conciliacionU'],
	$_POST['fecha_firma_concilU'],
	$_POST['valor_conciliarU'],
	$_POST['valor_entidadU'],
	$_POST['valor_epsU'],
	$_POST['valor_ratificadoU'],
	$_POST['observacion_concilU']);

echo $obj->actualizar($datos);

?>