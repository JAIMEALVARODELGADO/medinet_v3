<?php
require_once "../clases/conexion.php";
require_once "../clases/crudconsulta.php";
require_once "mn_funciones.php";
$obj=new crudconsulta();
/*$descripcion_def=$_POST['descripcion_def'];
foreach ($descripcion_def as $desc_ ) {
	echo $desc_;
}*/
$control_con='N';
if(isset($_POST['chk_control'])){
	if($_POST['chk_control']=='on'){$control_con='S';}
}

$violencia_sexual='N';
if(isset($_POST['chk_violencia_sexual'])){
	if($_POST['chk_violencia_sexual']=='on'){$violencia_sexual='S';}
}

$datos=array(
$_POST['tipoiden_dp'],
$_POST['numeroiden_dp'],
$_POST['nombre_dp'],
$_POST['direccion_dp'],
$_POST['telefono_dp'],
$_POST['fechanac_dp'],
$_POST['genero_dp'],
$_POST['etnia_dp'],
$_POST['ocupacion_dp'],
$_POST['niveleduc_dp'],
$_POST['estadociv_dp'],
$_POST['tipovin_dp'],
$_POST['tipoafil_dp'],
$_POST['grupopob_dp'],
$_POST['zonares_dp'],
$_POST['tipoiden_acu'],
$_POST['numeroiden_acu'],
$_POST['nombre_acu'],
$_POST['direccion_acu'],
$_POST['telefono_acu'],
$_POST['parentesco_acu'],
$_POST['motivo_con'],
$_POST['enfermedad_con'],
$_POST['revisionsist_con'],
$_POST['personales_ante'],
$_POST['familiares_ante'],
$_POST['id_cups'],
$_POST['finalidad_con'],
$_POST['causaext_con'],
$_POST['analisis_con'],
$_POST['dxprinc_con'],
$_POST['tipodx_con'],
$_POST['dxrela1_con'],
$_POST['dxrela2_con'],
$_POST['dxrela3_con'],
$_POST['plan_con'],
$_POST['observacion_con'],
$_POST['tensionart_sv'],
$_POST['frecresp_sv'],
$_POST['freccard_sv'],
$_POST['temperat_sv'],
$_POST['perimetrocef_sv'],
$_POST['peso_sv'],
$_POST['talla_sv'],
$_POST['indicemc_sv'],
$_POST['indicecc_sv'],
$_POST['observacion_sv'],
$_POST['descripcion_exaf'],
$_POST['valor_exaf'],
$_POST['hallazgo_exaf'],
$control_con,
$_POST['subjetivo_con'],
$_POST['objetivo_con'],
$violencia_sexual
);

echo $obj->agregar($datos);

?>