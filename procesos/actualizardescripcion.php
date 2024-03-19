<?php
require_once "../clases/conexion.php";
require_once "../clases/crudadjunto.php";
$obj=new crudadjunto();

$datos=array(
$_POST['id_adjunto'],	
$_POST['descripcion_adjU']
);

echo $obj->actualizar($datos);

?>