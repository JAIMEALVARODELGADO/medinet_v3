<?php
require_once "../clases/conexion.php";
require_once "../clases/crudglosas.php";
$obj=new crudglosas();
//$_POST['valor_fav_gloU'],
//$_POST['valor_fav_epsU'],
$datos=array($_POST['id_glosa'],
	$_POST['valor_gloU'],
	$_POST['motivo_gloU'],
	$_POST['fechaentrega_gloU'],
	$_POST['responsable_resp_gloU'],
	$_POST['fecha_envio_gloU'],
	$_POST['guia_gloU'],
	$_POST['respuesta_gloU']);

echo $obj->actualizar($datos);

?>