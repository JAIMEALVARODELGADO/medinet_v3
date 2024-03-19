<?php
require_once "../clases/conexion.php";
require_once "../clases/crudconciliacion.php";
$obj=new crudconciliacion();
$datos=array($_POST['id_eps'],
$_POST['id_factura'],
$_POST['fecha_conciliacion'],
$_POST['fecha_firma_concil'],
$_POST['valor_conciliar'],
$_POST['valor_entidad'],
$_POST['valor_eps'],
$_POST['valor_ratificado'],
$_POST['observacion_concil']);

echo $obj->agregar($datos);
?>
