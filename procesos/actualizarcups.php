<?php
require_once "../clases/conexion.php";
require_once "../clases/crudcups.php";
$obj=new crudcups();

$datos=array(
$_POST['id_cups'],
$_POST['codigo_cupsU'],
$_POST['descripcion_cupsU'],
$_POST['norma_cupsU']
);

echo $obj->actualizar($datos);

?>