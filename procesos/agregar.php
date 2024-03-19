<?php
require_once "../clases/conexion.php";
require_once "../clases/crud.php";
$obj=new crud();

$datos=array($_POST['codigo_eps'],
$_POST['nit_eps'],
$_POST['nombre_eps'],
$_POST['direccion_eps'],
$_POST['telefono_eps'],
$_POST['contacto_eps']);

echo $obj->agregar($datos);

?>