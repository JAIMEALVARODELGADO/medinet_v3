<?php
require_once "../clases/conexion.php";
require_once "../clases/crudfactura.php";
$obj=new crudfactura();

$datos=array($_POST['copago_fac'],
	$_POST['descuento_fac']
	);

echo $obj->actualizarcopago($datos);

?>