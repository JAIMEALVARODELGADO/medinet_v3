<?php
require_once "../clases/conexion.php";
require_once "../clases/crudmedicameformula.php";
$obj=new crudmedicameformula();

$datos=array(
$_POST['id_medicamento'],
$_POST['dosis_det'],
$_POST['frecuencia_det'],
$_POST['via_det'],
$_POST['tiempo_trat_det'],
$_POST['cantidad_det'],
$_POST['observacion_det']);

echo $obj->agregar($datos);

?>