<?php
require_once "../clases/conexion.php";
require_once "../clases/crudfurips.php";
require_once "mn_funciones.php";
$obj=new crudfurips();
$datos=array($_POST['tipo_refer'],
$_POST['fecha_remi'],
$_POST['hora_salida'],
$_POST['cod_habilitacion_remi'],
$_POST['nombre_ent_remite'],
$_POST['profesional_remite'],
$_POST['cargo_remite'],
$_POST['fecha_ingre_remi'],
$_POST['id_profesional_recibe']
);

echo $obj->agregar_remision($datos);
?>
