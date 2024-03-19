<?php
require_once "../clases/conexion.php";
require_once "../clases/crudglosausu.php";
$obj=new crudglosausu();

$datos=array($_POST['id_persona'],
$_POST['id_conglo']
);

echo $obj->agregar($datos);

?>