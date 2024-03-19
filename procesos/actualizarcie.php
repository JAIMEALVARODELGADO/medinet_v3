<?php
require_once "../clases/conexion.php";
require_once "../clases/crudcie.php";
$obj=new crudcie();

$datos=array(
$_POST['id_cie'],
$_POST['codigo_cieU'],
$_POST['descripcion_cieU']
);

echo $obj->actualizar($datos);

?>