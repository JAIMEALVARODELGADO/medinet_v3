<?php
require_once "../clases/conexion.php";
require_once "../clases/crudact_convenio.php";
$obj=new crudact_convenio();

$datos=array($_POST['descripcion_cdet'],
$_POST['tipo_cdet'],
$_POST['codigo_cdet'],
$_POST['valor_cdet']);

echo $obj->agregar($datos);

?>