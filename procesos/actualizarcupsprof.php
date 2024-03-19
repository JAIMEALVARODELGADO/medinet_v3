<?php
require_once "../clases/conexion.php";
require_once "../clases/crudcupsprof.php";
$obj=new crudcupsprof();

$datos=array(
$_POST['idcups_prof'],
$_POST['id_cupsU'],
$_POST['clase_cprofU']
);

echo $obj->actualizar($datos);

?>