<?php
require_once "../clases/conexion.php";
require_once "../clases/crudconcepto.php";
$obj=new crudconcepto();

$datos=array($_POST['id_grupo'],
$_POST['descripcion_det'],
$_POST['valor_det']);

echo $obj->agregar($datos);

?>