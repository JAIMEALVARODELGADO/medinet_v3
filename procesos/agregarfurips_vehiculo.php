<?php
require_once "../clases/conexion.php";
require_once "../clases/crudfurips.php";
require_once "mn_funciones.php";
$obj=new crudfurips();
$intervencion_aut=0;
$cobro_excedente=0;
if(isset($_POST['intervencion_aut']) AND $_POST['intervencion_aut']=='on'){$intervencion_aut=1;}
if(isset($_POST['cobro_excedente']) AND $_POST['cobro_excedente']=='on'){$cobro_excedente=1;}

$datos=array($_POST['estado_aseg'],
$_POST['marca_vehiculo'],
$_POST['placa_vehiculo'],
$_POST['tipo_vehiculo'],
$_POST['codigo_aseg'],
$_POST['nombre_aseg'],
$_POST['numero_poliza'],
$_POST['fecha_inicio'],
$_POST['fecha_final'],
$intervencion_aut,
$cobro_excedente,
$_POST['placa_vehiculo2'],
$_POST['tipoiden_propvehi2'],
$_POST['identprop_vehi2'],
$_POST['placa_vehiculo3'],
$_POST['tipoiden_propvehi3'],
$_POST['identprop_vehi3'],
$_POST['id_propietario'],
$_POST['id_conductor']);

echo $obj->agregar_vehiculo($datos);
?>
