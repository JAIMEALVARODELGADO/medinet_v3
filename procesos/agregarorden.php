<?php
require_once "../clases/conexion.php";
require_once "../clases/crudorden.php";
//require_once "mn_funciones.php";
$obj=new crudorden();
$datos=array($_POST['id_aten'],
$_POST['tipo_ord'],
$_POST['id_cups'],
$_POST['observacion_det']);
echo $obj->agregarord($datos);
?>