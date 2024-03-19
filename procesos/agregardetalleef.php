<?php
require_once "../clases/conexion.php";
require_once "../clases/cruddetalleef.php";
$obj=new cruddetalleef();

$datos=array($_POST['descripcion_def']);
echo $obj->agregar($datos);
?>