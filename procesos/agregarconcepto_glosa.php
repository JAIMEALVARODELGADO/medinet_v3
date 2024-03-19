<?php
require_once "../clases/conexion.php";
require_once "../clases/crudconcepto_glosa.php";
$obj=new crudconcepto_glosa();

$datos=array($_POST['id_glosacod'],
$_POST['codigo_conglo'],
$_POST['descripcion_conglo']);

echo $obj->agregar($datos);

?>