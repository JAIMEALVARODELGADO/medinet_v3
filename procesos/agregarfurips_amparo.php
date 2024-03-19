<?php
require_once "../clases/conexion.php";
require_once "../clases/crudfurips.php";
require_once "mn_funciones.php";
$obj=new crudfurips();
$datos=array($_POST['total_facturado'],
$_POST['total_reclamo'],
$_POST['total_transporte'],
$_POST['total_reclamo_trans'],
$_POST['total_folios']
);

echo $obj->agregar_amparo($datos);
?>
