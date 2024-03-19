<?php
require_once "../clases/conexion.php";
require_once "../clases/crudmenu.php";
//require_once "mn_funciones.php";
$obj=new crudmenu();

$datos=array($_POST['id_menu'],
$_POST['id_persona']);
echo $obj->actualizar($datos);
?>