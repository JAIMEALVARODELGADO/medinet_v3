<?php
require_once "../clases/conexion.php";
require_once "../clases/crudrips.php";
$obj=new crudrips();
$datos=array(
$_POST['id_ripsap'],
$_POST['fechaproc_rap'],
$_POST['numeroauto_rap'],
$_POST['codigoproc_rap'],
$_POST['ambito_rap'],
$_POST['finalidad_rap'],
$_POST['dxprincipal_rap'],
$_POST['dxrelac_rap'],
$_POST['complica_rap'],
$_POST['valor_rap']);
echo $obj->actualizarap($datos);
?>