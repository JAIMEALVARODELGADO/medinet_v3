<?php
require_once "../clases/conexion.php";
require_once "../clases/cruddetalle_paquete.php";
$obj=new cruddetalle_paquete();

$datos=array($_POST['id_medpq'],
$_POST['id_medicamentoU'],
$_POST['cantidad_medpqU']);

echo $obj->actualizar($datos);

?>