<?php
require_once "../clases/conexion.php";
require_once "../clases/crudciuo.php";
$obj=new crudciuo();

$datos=array($_POST['codigo_ciuo'],
$_POST['descripcion_ciu']
);

echo $obj->agregar($datos);

?>