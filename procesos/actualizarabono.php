<?php
require_once "../clases/conexion.php";
require_once "../clases/crudabono.php";
$obj=new crudabono();
$datos=array($_POST['id_abono'],	
	$_POST['id_facturaU'],
	$_POST['fecha_abonoU'],
	$_POST['documento_abonoU'],
	$_POST['valor_abonoU'],
	$_POST['dias_mora_abonoU'],
	$_POST['observacion_abonoU']
	);

echo $obj->actualizar($datos);

?>