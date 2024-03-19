<?php
require_once "../clases/conexion.php";
require_once "../clases/crudentidad.php";
$obj=new crudentidad();

$datos=array(
$_POST['id_ent'],
$_POST['nombre_entU'],
$_POST['direccion_entU'],
$_POST['telefono_entU'],
$_POST['textofactura_entU'],
$_POST['tipoiden_entU'],
$_POST['numeroiden_entU'],
$_POST['codigopres_entU'],
$_POST['prefijofac_entU'],
$_POST['tituloenc_entU'],
$_POST['nombreenc_entU']
);
echo $obj->actualizar($datos);
?>