<?php
require_once "../clases/conexion.php";
require_once "../clases/crudabono.php";
$obj=new crudabono();
$datos=array($_POST['id_eps'],
$_POST['id_factura'],
$_POST['fecha_abono'],
$_POST['documento_abono'],
$_POST['valor_abono'],
$_POST['dias_mora_abono'],
$_POST['observacion_abono']);

echo $obj->agregar($datos);
?>
