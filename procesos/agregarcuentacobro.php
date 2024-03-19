<?php
require_once "../clases/conexion.php";
require_once "../clases/crudcuentacobro.php";
$obj=new crudcuentacobro();
$datos=array($_POST['numero_ccob'],
$_POST['fecha_ccob'],
$_POST['fechaini_ccob'],
$_POST['fechafin_ccob'],
$_POST['id_eps'],
$_POST['concepto_ccob']);

echo $obj->agregar($datos);

?>