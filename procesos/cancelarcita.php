<?php
require_once "../clases/conexion.php";
require_once "../clases/crudcita.php";
//require_once "mn_funciones.php";
$obj=new crudcita();

$datos=array($_POST['id_agc'],
$_POST['id_agh'],
$_POST['observacion_agc']);

echo $obj->cancelar($datos);

?>