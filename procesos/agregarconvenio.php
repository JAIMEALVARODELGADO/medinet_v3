<?php
require_once "../clases/conexion.php";
require_once "../clases/crudconvenio.php";
$obj=new crudconvenio();

$datos=array($_POST['id_eps'],
$_POST['numero_conv'],
$_POST['fecha_conv'],
$_POST['observacion_conv']);

echo $obj->agregar($datos);

?>