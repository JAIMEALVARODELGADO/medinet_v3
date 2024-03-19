<?php
require_once "../clases/conexion.php";
require_once "../clases/crudglosas.php";
$obj=new crudglosas();
//$_POST['valor_fav_glo'],
//$_POST['valor_fav_eps'],
$datos=array(
$_POST['fecharecep_glo'],
$_POST['id_eps'],
$_POST['id_factura'],
$_POST['valor_glo'],
$_POST['motivo_glo'],
$_POST['fechaentrega_glo'],
$_POST['responsable_resp_glo'],
$_POST['fecha_envio_glo'],
$_POST['guia_glo']
);

echo $obj->agregar($datos);

?>
