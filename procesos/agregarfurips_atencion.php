<?php
require_once "../clases/conexion.php";
require_once "../clases/crudfurips.php";
require_once "mn_funciones.php";
$obj=new crudfurips();
$datos=array($_POST['fecha_ingreso'],
$_POST['fecha_egreso'],
$_POST['dx_principal_ingre'],
$_POST['dx_relac1_ingre'],
$_POST['dx_relac2_ingre'],
$_POST['dx_principal_egre'],
$_POST['dx_relac1_egre'],
$_POST['dx_relac2_egre'],
$_POST['id_profesional']
);

echo $obj->agregar_atencion($datos);
?>
