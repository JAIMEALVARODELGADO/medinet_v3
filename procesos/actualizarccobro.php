<?php
require_once "../clases/conexion.php";
require_once "../clases/crudcuentacobro.php";
$obj=new crudcuentacobro;

$datos=array($_POST['id_ccobro'],
	$_POST['numero_ccobU'],
	$_POST['fecha_ccobU'],
	$_POST['fechaini_ccobU'],
	$_POST['fechafin_ccobU'],
	$_POST['concepto_ccobU']);

echo $obj->actualizar($datos);

?>