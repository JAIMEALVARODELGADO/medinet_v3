<?php
require_once "../clases/conexion.php";
require_once "../clases/crudcups.php";
$obj=new crudcups();

$datos=array($_POST['codigo_cups'],
$_POST['descripcion_cups'],
$_POST['norma_cups']
);

echo $obj->agregar($datos);

?>