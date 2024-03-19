<?php
require_once "../clases/conexion.php";
require_once "../clases/crudprocedimiento.php";
$obj=new crudprocedimiento();

$datos=array(
$_POST['id_procedimiento'],	
$_POST['id_cupsU'],	
$_POST['ambito_procU'],
$_POST['finalidad_procU'],
$_POST['dxprinc_procU'],
$_POST['dxrelac_procU'],
$_POST['complic_procU'],
$_POST['forma_procU'],
$_POST['observacion_procU']
);

echo $obj->actualizar($datos);

?>