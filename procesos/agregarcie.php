<?php
require_once "../clases/conexion.php";
require_once "../clases/crudcie.php";
$obj=new crudcie();

$datos=array($_POST['codigo_cie'],
$_POST['descripcion_cie']
);

echo $obj->agregar($datos);

?>