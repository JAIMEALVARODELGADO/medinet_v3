<?php
require_once "../clases/conexion.php";
require_once "../clases/crudfurips.php";
require_once "mn_funciones.php";
$obj=new crudfurips();

$datos=array($_POST['numero_recant'],
$_POST['respglo_recla'],
$_POST['id_factura'],
$_POST['condi_victima'],
$_POST['naturaleza_even'],
$_POST['descripcion_even'],
$_POST['direccion_even'],
$_POST['fecha_even'],
$_POST['municipio_even'],
$_POST['zona_even']);

echo $obj->agregar_reclamacion($datos);
?>
