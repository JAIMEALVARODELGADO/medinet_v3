<?php
require_once "../clases/conexion.php";
require_once "../clases/crudprocedimiento.php";
$obj=new crudprocedimiento();

$datos=array(
$_POST['id_cups'],
$_POST['ambito_proc'],
$_POST['finalidad_proc'],
$_POST['dxprinc_proc'],
$_POST['dxrelac_proc'],
$_POST['complic_proc'],
$_POST['forma_proc'],
$_POST['observacion_proc']);

echo $obj->agregar($datos);

?>