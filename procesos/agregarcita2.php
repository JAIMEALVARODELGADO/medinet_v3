<?php
require_once "../clases/conexion.php";
require_once "../clases/crudcita2.php";
require_once "mn_funciones.php";
$obj=new crudcita2();

$datos=array($_POST['id_persona'],
$_POST['id_eps'],
$_POST['id_profesional'],
$_POST['fecha_agh'],
$_POST['observacion_agc']);

echo $obj->agregar($datos);

?>