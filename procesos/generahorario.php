<?php
require_once "../clases/conexion.php";
require_once "../clases/crudhorario.php";
$obj=new crudhorario();

$datos=array(
$_POST['id_profesional'],
$_POST['fecha_ini'],
$_POST['hora_ini'],
$_POST['fecha_fin'],
$_POST['hora_fin'],
$_POST['minutos'],
$_POST['turnos'],
$_POST['domingo'],
$_POST['lunes'],
$_POST['martes'],
$_POST['miercoles'],
$_POST['jueves'],
$_POST['viernes'],
$_POST['sabado'],
);

echo $obj->agregar($datos);

?>