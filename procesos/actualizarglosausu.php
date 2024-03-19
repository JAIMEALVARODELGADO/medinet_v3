<?php
require_once "../clases/conexion.php";
require_once "../clases/crudglosausu.php";
$obj=new crudglosausu();

$datos=array(
$_POST['id_conper'],
$_POST['id_congloU']
);

echo $obj->actualizar($datos);

?>