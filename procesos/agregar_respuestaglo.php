<?php
require_once "../clases/conexion.php";
require_once "../clases/crud_respuestaglo.php";
$obj=new crud_respuestaglo();
$datos=array($_POST['id_detfac'],
$_POST['fechacont_resp'],
$_POST['id_conglo'],
$_POST['valoracepta_resp'],
$_POST['observacion_resp']
);
echo $obj->agregar($datos);
?>