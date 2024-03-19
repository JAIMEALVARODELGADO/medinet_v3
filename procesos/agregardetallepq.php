<?php
require_once "../clases/conexion.php";
require_once "../clases/cruddetalle_paquete.php";
$obj=new cruddetalle_paquete();
$datos=array($_POST['id_medicamento'],
$_POST['cantidad_medpq']);
echo $obj->agregar($datos);
?>