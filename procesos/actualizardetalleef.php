<?php
require_once "../clases/conexion.php";
require_once "../clases/cruddetalleef.php";
$obj=new cruddetalleef();

$datos=array($_POST['id_def'],
$_POST['descripcion_defU']);

echo $obj->actualizar($datos);

?>