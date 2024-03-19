<?php
require_once "../clases/conexion.php";
require_once "../clases/crudpersona.php";
$obj=new crudpersona();
$datos=array($_POST['tipo_iden_per'],
$_POST['numero_iden_per'],
$_POST['pnom_per'],
$_POST['snom_per'],
$_POST['pape_per'],
$_POST['sape_per'],
$_POST['fnac_per'],
$_POST['sexo_per'],
$_POST['direccion_per'],
$_POST['telefono_per'],
$_POST['email_per']);

echo $obj->agregar($datos);
?>