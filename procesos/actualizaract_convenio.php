<?php
require_once "../clases/conexion.php";
require_once "../clases/crudact_convenio.php";
$obj=new crudact_convenio();

$datos=array($_POST['id_cdet'],
$_POST['descripcion_cdetU'],
$_POST['tipo_cdetU'],
$_POST['codigo_cdetU'],
$_POST['valor_cdetU']);

echo $obj->actualizar($datos);

?>