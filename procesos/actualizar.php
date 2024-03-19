<?php
require_once "../clases/conexion.php";
require_once "../clases/crud.php";
$obj=new crud();

$datos=array($_POST['ideps'],
	$_POST['codigo_epsU'],
	$_POST['nit_epsU'],
	$_POST['nombre_epsU'],
	$_POST['direccion_epsU'],
	$_POST['telefono_epsU'],
	$_POST['contacto_epsU']);

echo $obj->actualizar($datos);

?>