<?php
require_once "../clases/conexion.php";
require_once "../clases/crudrips.php";
$obj=new crudrips();
$datos=array(
$_POST['id_ripsac'],
$_POST['fechacon_rac'],
$_POST['numeroauto_rac'],
$_POST['codigocon_rac'],
$_POST['finalidad_rac'],
$_POST['causaexte_rac'],
$_POST['dxprincipal_rac'],
$_POST['dxrel1_rac'],
$_POST['dxrel2_rac'],
$_POST['dxrel3_rac'],
$_POST['tipodxprin_rac'],
$_POST['valorcon_rac'],
$_POST['valorcmode_rac']);
echo $obj->actualizar($datos);

?>