<?php
require_once "../clases/conexion.php";
require_once "../clases/crudfurips_persona.php";
$obj=new crudfurips_persona();

$datos=array(
	$_POST['idpersona'],
	$_POST['tipo_identU'],
	$_POST['numero_identU'],
	$_POST['pape_perU'],
	$_POST['sape_perU'],
	$_POST['pnom_perU'],
	$_POST['snom_perU'],	
	$_POST['direccion_perU'],
	$_POST['telefono_perU'],
	$_POST['municipio_perU']);

echo $obj->actualizar($datos);

?>