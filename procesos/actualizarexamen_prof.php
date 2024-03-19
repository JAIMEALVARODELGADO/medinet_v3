<?php
require_once "../clases/conexion.php";
require_once "../clases/crudusuario.php";
$obj=new crudusuario();
/*$agendar='N';
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
}*/

$datos=array(
$_POST['id_personaE'],
$_POST['id_mefU']);

echo $obj->actualizar_examen($datos);

?>