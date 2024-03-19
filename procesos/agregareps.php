<?php
require_once "../clases/conexion.php";
require_once "../clases/crudeps.php";
$obj=new crudeps();

$datos=array($_POST['codigo_eps'],
$_POST['nit_eps'],
$_POST['nombre_eps'],
$_POST['direccion_eps'],
$_POST['telefono_eps'],
$_POST['contacto_eps']);

echo $obj->agregar($datos);

?>