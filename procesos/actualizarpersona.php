<?php
require_once "../clases/conexion.php";
require_once "../clases/crudpersona.php";
$obj=new crudpersona();

$datos=array(
	$_POST['idpersona'],
	$_POST['tipo_iden_perU'],
	$_POST['numero_iden_perU'],
	$_POST['pnom_perU'],
	$_POST['snom_perU'],
	$_POST['pape_perU'],
	$_POST['sape_perU'],
	$_POST['fnac_perU'],
	$_POST['sexo_perU'],
	$_POST['direccion_perU'],
	$_POST['telefono_perU'],
	$_POST['email_perU']);

echo $obj->actualizar($datos);

?>