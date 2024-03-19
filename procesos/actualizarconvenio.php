<?php
require_once "../clases/conexion.php";
require_once "../clases/crudconvenio.php";
$obj=new crudconvenio();

$datos=array($_POST['id_convenio'],
	$_POST['numero_convU'],
	$_POST['fecha_convU'],
	$_POST['observacion_convU']);

echo $obj->actualizar($datos);

?>