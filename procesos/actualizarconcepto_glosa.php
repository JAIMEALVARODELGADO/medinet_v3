<?php
require_once "../clases/conexion.php";
require_once "../clases/crudconcepto_glosa.php";
$obj=new crudconcepto_glosa();

$datos=array(
$_POST['id_conglo'],
$_POST['id_glosacodU'],
$_POST['codigo_congloU'],
$_POST['descripcion_congloU']
);

echo $obj->actualizar($datos);

?>