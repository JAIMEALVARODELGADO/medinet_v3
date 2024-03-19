<?php
require_once "../clases/conexion.php";
require_once "../clases/crudfurips_persona.php";
$obj=new crudfurips_persona();

$datos=array($_POST['tipo_ident'],
$_POST['numero_ident'],
$_POST['pape_per'],
$_POST['sape_per'],
$_POST['pnom_per'],
$_POST['snom_per'],
$_POST['direccion_per'],
$_POST['telefono_per'],
$_POST['municipio_per']);
echo $obj->agregar($datos);
?>