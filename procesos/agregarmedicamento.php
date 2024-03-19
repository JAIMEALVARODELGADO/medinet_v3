<?php
require_once "../clases/conexion.php";
require_once "../clases/crudmedicamento.php";
$obj=new crudmedicamento();

$datos=array($_POST['codigoatc_mto'],
$_POST['nombre_mto'],
$_POST['tipo_mto']);

echo $obj->agregar($datos);

?>