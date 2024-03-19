<?php
require_once "../clases/conexion.php";
require_once "../clases/crudconcepto.php";
$obj=new crudconcepto();

$datos=array(
$_POST['codi_det'],
$_POST['id_grupoU'],
$_POST['descripcion_detU'],
$_POST['valor_detU']
);

echo $obj->actualizar($datos);

?>