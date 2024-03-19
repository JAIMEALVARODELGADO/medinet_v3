<?php
require_once "../clases/conexion.php";
require_once "../clases/crudfactura.php";
$obj=new crudfactura();
$datos=array($_POST['id_persona'],
$_POST['id_convenio'],
$_POST['fecha_fac'],
$_POST['fechaini_fac'],
$_POST['fechafin_fac'],
$_POST['id_aten'],
$_POST['id_procedimiento'],
$_POST['formapago_fac']
);

echo $obj->agregar($datos);

?>