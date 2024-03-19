<?php
require_once "../clases/conexion.php";
require_once "../clases/crudpersona.php";
$obj=new crudpersona();
//echo $_POST['idpersona_pac'];
$datos=array(
	$_POST['idpersona_pac'],
	$_POST['codigo_munU'],
	$_POST['zonaU'],
	$_POST['tipo_usuarioU'],
	$_POST['etniaU'],
	$_POST['nivel_educU'],
	$_POST['id_ciuoU'],
	$_POST['estado_civU']);

echo $obj->actualizarpaciente($datos);

?>