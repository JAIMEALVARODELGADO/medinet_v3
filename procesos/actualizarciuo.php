<?php
require_once "../clases/conexion.php";
require_once "../clases/crudciuo.php";
$obj=new crudciuo();

$datos=array(
$_POST['id_ciuo'],
$_POST['codigo_ciuoU'],
$_POST['descripcion_ciuU']
);

echo $obj->actualizar($datos);

?>