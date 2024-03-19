<?php
require_once "../clases/conexion.php";
require_once "../clases/crudusuario.php";
$obj=new crudusuario();
$agendar='N';
if(isset($_POST['agendar_usuU']) AND $_POST['agendar_usuU']=='on'){	
	$agendar='S';
}
$signos='N';
if(isset($_POST['tomasignos_usuU']) AND $_POST['tomasignos_usuU']=='on'){	
	$signos='S';
}
$examen='N';
if(isset($_POST['examenfis_usuU']) AND $_POST['examenfis_usuU']=='on'){	
	$examen='S';
}

$datos=array(
$_POST['id_personaU'],
$_POST['login_usuU'],
$_POST['password_usuU'],
$_POST['password_ant'],
$_POST['profesionU'],
$_POST['registro_usuU'],
$_POST['cargo_usuU'],
$agendar,
$signos,
$examen);

echo $obj->actualizar($datos);

?>