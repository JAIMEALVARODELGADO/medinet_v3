<?php
require_once "../clases/conexion.php";
require_once "../clases/crud_respuestaglo.php";
$obj=new crud_respuestaglo();
$datos=array($_POST['id_resp'],
$_POST['id_detfacU'],
$_POST['fechacont_respU'],
$_POST['id_congloU'],
$_POST['valoracepta_respU'],
$_POST['observacion_respU']);
echo $obj->actualizar($datos);

?>