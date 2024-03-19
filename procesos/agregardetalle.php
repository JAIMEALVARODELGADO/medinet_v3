<?php
require_once "../clases/conexion.php";
require_once "../clases/cruddetalle.php";
$obj=new cruddetalle();

$datos=array($_POST['id_cdet'],
$_POST['cantidad_detfac'],
$_POST['valor_unit_detfac']);

echo $obj->agregar($datos);

?>