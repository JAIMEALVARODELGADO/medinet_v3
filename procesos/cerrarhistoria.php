<?php
require_once "../clases/conexion.php";
require_once "../clases/crudconsulta.php";
$obj=new crudconsulta();

$datos=array($_POST['id_aten']);

echo $obj->cerrarhistoria($datos);

?>