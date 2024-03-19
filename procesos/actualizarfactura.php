<?php
require_once "../clases/conexion.php";
require_once "../clases/crudfactura.php";
$obj=new crudfactura();

$datos=array($_POST['id_factura'],
	$_POST['fecha_fac'],
	$_POST['formapago_fac'],
	$_POST['copago_fac'],
	$_POST['descuento_fac']);

echo $obj->actualizar($datos);

?>