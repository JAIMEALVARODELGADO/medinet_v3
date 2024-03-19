<?php
require_once "../clases/conexion.php";
require_once "../clases/crudmedicameformula.php";
$obj=new crudmedicameformula();

$datos=array(
$_POST['id_det'],	
$_POST['id_medicamentoU'],
$_POST['dosis_detU'],
$_POST['frecuencia_detU'],
$_POST['via_detU'],
$_POST['tiempo_trat_detU'],
$_POST['cantidad_detU'],
$_POST['observacion_detU']
);

echo $obj->actualizar($datos);

?>