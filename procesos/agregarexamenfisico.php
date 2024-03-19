<?php
require_once "../clases/conexion.php";
require_once "../clases/crudexamen.php";
$obj=new crudexamen();

$datos=array($_POST['descripcion_mef']);
echo $obj->agregar($datos);

?>