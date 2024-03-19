<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();

ob_end_clean();//Limpiar (eliminar) el búfer de salida y deshabilitar el almacenamiento en el mismo
//require('../librerias/fpdf/fpdf.php');
include('../librerias/fpdf/fpdf.php');

function imprecuadro($col_,$fil_,$texto_,&$pdf){
    $c_=0;
    $cols_=strlen($texto_);
    for($c_==0;$c_<$cols_;$c_++){
        $pdf->SetXY($col_,$fil_);
        $pdf->Cell(3,3,substr($texto_,$c_,1),1,4,'C');
        $col_=$col_+3;
    }
}

$pdf=new FPDF('P','mm','Letter');
$pdf->AddPage();    
$pdf->SetFont('Arial','',7);
//echo $_POST['id_reclamacion'];
$consemp="SELECT * FROM entidad";
$consemp=mysqli_query($conexion,$consemp);
$rowemp=mysqli_fetch_array($consemp);

$consulta="SELECT id_persona,tipo_iden,numero_iden_per,pnom_per,snom_per,pape_per,sape_per,fnac_per,sexo,direccion_per,telefono_per,codigo_dep,nombre_dep,codigo_mun,nombre_mun,numero_fac,
respglo_recla,cod_condi_victima,cod_naturaleza_even,descripcion_even,direccion_even,fecha_even,municipio_even,nombre_mun_even,cod_depart_even,nombre_dep_even,zona_even
FROM vw_furips_reclamacion
WHERE id_reclamacion='$_POST[id_reclamacion]'";
$consulta=mysqli_query($conexion,$consulta);
$row=mysqli_fetch_array($consulta);

$pdf->Image('imagenes/FURIPSPAG1.jpg',15,10,185,250);
$pdf->SetFont('Arial','',7);
$fila=33;
if($row['respglo_recla']<>''){    
    $pdf->SetXY(118,$fila);
    $pdf->Cell(4,4,"X",0,3,'R');
}
$fila=$fila+7;
/*$pdf->SetXY(45,$fila);
$pdf->Cell(20,4,$row[radant_rec],0,3,'L');*/

$pdf->SetXY(150,$fila);
$pdf->Cell(20,4,$row['numero_fac'],0,3,'L');
$fila=$fila+9;
imprecuadro(40,$fila,$rowemp['nombre_ent'],$pdf);
$fila=$fila+4;
imprecuadro(40,$fila,$rowemp['codigopres_ent'],$pdf);
imprecuadro(127,$fila,$rowemp['numeroiden_ent'],$pdf);
$fila=$fila+5;
imprecuadro(40,$fila,substr($rowemp['direccion_ent'],0,51),$pdf);
$fila=$fila+4;
imprecuadro(40,$fila,"NARIÑO",$pdf);
imprecuadro(127,$fila,"52",$pdf);
imprecuadro(152,$fila,$rowemp['telefono_ent'],$pdf);
$fila=$fila+4;
imprecuadro(40,$fila,"PASTO",$pdf);
imprecuadro(153,$fila,"001",$pdf);
$fila=$fila+8;
$pdf->SetXY(20,$fila);
$pdf->Cell(85,3,$row['pape_per'],1,3,'C');
$pdf->SetXY(114,$fila);
$pdf->Cell(82,3,$row['sape_per'],1,3,'C');
$fila=$fila+7;
$pdf->SetXY(20,$fila);
$pdf->Cell(85,3,$row['pnom_per'],1,3,'C');
$pdf->SetXY(114,$fila);
$pdf->Cell(82,3,$row['snom_per'],1,3,'C');
switch($row['tipo_iden']){
    case 'CC':
        $col=50;
        break;
    case 'CE':
        $col=54;
        break;
    case 'PA':
        $col=58;
        break;
    case 'TI':
        $col=62;
        break;
    case 'RC':
        $col=67;
        break;
    case 'AS':
        $col=71;
        break;
    case 'MS':
        $col=75;
        break;        
}
$fila=$fila+6;
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
imprecuadro(127,$fila,$row['numero_iden_per'],$pdf);
$fila=$fila+5;
$fnac_per=cambiafechadmy($row['fnac_per']);
$fnac_per=substr($fnac_per,0,2).substr($fnac_per,3,2).substr($fnac_per,6,4);
imprecuadro(49,$fila,$fnac_per,$pdf);

if($row['sexo']=='F'){$col=107;}
else{$col=116;}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
$fila=$fila+4;
imprecuadro(49,$fila,$row['direccion_per'],$pdf);
$fila=$fila+4;
imprecuadro(40,$fila,$row['nombre_dep'],$pdf);
imprecuadro(132,$fila,$row['codigo_dep'],$pdf);
imprecuadro(158,$fila,$row['telefono_per'],$pdf);
$fila=$fila+5;
imprecuadro(40,$fila,$row['nombre_mun'],$pdf);
imprecuadro(132,$fila,$row['codigo_mun'],$pdf);

switch($row['cod_condi_victima']){
    case '1':
        $col=58;
        break;
    case '2':
        $col=88;
        break;
    case '3':
        $col=119;
        break;
    case '4':
        $col=154;
        break;
}
$fila=$fila+4;
//Datos del sitio donde ocurrio el evento
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
switch($row['cod_naturaleza_even']){
    case '01':
        $col=62;
        $fila=$fila+13;
        break;
    case '02':
        $col=62;
        $fila=$fila+17;
        break;
    case '03':
        $col=93;
        $fila=$fila+17;
        break;
    case '04':
        $col=127;
        $fila=$fila+17;
        break;
    case '05':
        $col=127;
        $fila=$fila+21;
        break;
    case '06':
        $col=62;
        $fila=$fila+21;
        break;
    case '07':
        $col=93;
        $fila=$fila+21;
        break;
    case '08':
        $col=158;
        $fila=$fila+21;
        break;
    case '09':
        $col=62;
        $fila=$fila+26;
        break;
    case '10':
        $col=62;
        $fila=$fila+30;
        break;
    case '11':
        $col=158;
        $fila=$fila+26;
        break;
    case '12':
        $col=93;
        $fila=$fila+30;
        break;
    case '13':
        $col=62;
        $fila=$fila+26;
        break;    
    case '15':
        $col=127;
        $fila=$fila+26;
        break;    
    case '16':
        $col=158;
        $fila=$fila+17;
        break;
    case '17':
        $col=27;
        $fila=$fila+34;
        break;
}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');

$fila=143;
$fila=$fila+4;
imprecuadro(53,$fila,$row['direccion_even'],$pdf);
$hora_even=substr($row['fecha_even'],11,5);
$fecha_even=cambiafechadmy($row['fecha_even']);
$fecha_even=substr($fecha_even,0,2).substr($fecha_even,3,2).substr($fecha_even,6,4);
$fila=$fila+5;
imprecuadro(53,$fila,$fecha_even,$pdf);
imprecuadro(118,$fila,$hora_even,$pdf);
//,,,nombre_ep_even
$fila=$fila+4;
imprecuadro(40,$fila,$row['nombre_dep_even'],$pdf);
imprecuadro(132,$fila,$row['cod_depart_even'],$pdf);
$fila=$fila+4;
imprecuadro(40,$fila,$row['nombre_mun_even'],$pdf);
imprecuadro(132,$fila,$row['municipio_even'],$pdf);
if($row['zona_even']=='U'){$col=163;}
else{$col=172;}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
$fila=$fila+11;
$pdf->SetXY(15,$fila);
$pdf->MultiCell(185,3,$row['descripcion_even'],0,'J');

//Datos del vehiculo
$consveh="SELECT vw_furips_vehiculo.cod_estado_aseg,vw_furips_vehiculo.marca_vehiculo,vw_furips_vehiculo.placa_vehiculo,vw_furips_vehiculo.cod_tipo_vehiculo,vw_furips_vehiculo.codigo_aseg,vw_furips_vehiculo.nombre_aseg,vw_furips_vehiculo.numero_poliza,vw_furips_vehiculo.fecha_inicio,vw_furips_vehiculo.fecha_final,vw_furips_vehiculo.intervencion_aut,vw_furips_vehiculo.cobro_excedente,vw_furips_vehiculo.placa_vehiculo2,vw_furips_vehiculo.tipoiden_propvehi2,vw_furips_vehiculo.identprop_vehi2,vw_furips_vehiculo.placa_vehiculo3,vw_furips_vehiculo.tipoiden_propvehi3,vw_furips_vehiculo.identprop_vehi3,
    vw_furips_vehiculo.tipo_ident_prop,vw_furips_vehiculo.numero_ident_prop,vw_furips_vehiculo.pape_prop,vw_furips_vehiculo.sape_prop,vw_furips_vehiculo.pnom_prop,snom_prop,vw_furips_vehiculo.direccion_prop,vw_furips_vehiculo.telefono_prop,vw_furips_vehiculo.municipio_prop,
    vw_furips_vehiculo.tipo_ident_cond,vw_furips_vehiculo.numero_ident_cond,vw_furips_vehiculo.pape_cond,vw_furips_vehiculo.sape_cond,vw_furips_vehiculo.pnom_cond,snom_cond,vw_furips_vehiculo.direccion_cond,vw_furips_vehiculo.telefono_cond,vw_furips_vehiculo.municipio_cond
FROM vw_furips_vehiculo 
WHERE id_reclamacion='$_POST[id_reclamacion]'";
//echo $consveh;
$consveh=mysqli_query($conexion,$consveh);
$rowveh=mysqli_fetch_array($consveh);
$finipol_veh='';
$ffinpol_veh='';
if($rowveh['fecha_inicio']<>'0000-00-00'){$finipol_veh=cambiafechadmy($rowveh['fecha_inicio']);}
if($rowveh['fecha_final']<>'0000-00-00'){$ffinpol_veh=cambiafechadmy($rowveh['fecha_final']);}
switch($rowveh['cod_estado_aseg']){
    case '1':
        $col=67;
        break;
    case '2':
        $col=93;
        break;
    case '3':
        $col=123;
        break;
    case '4':
        $col=145;
        break;
    case '5':
        $col=171;
        break;    
}
$fila=$fila+20;
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
$fila=$fila+4;
$pdf->SetXY(23,$fila);
$pdf->Cell(80,3,$rowveh['marca_vehiculo'],1,3,'L');
imprecuadro(136,$fila,$rowveh['placa_vehiculo'],$pdf);
switch($rowveh['cod_tipo_vehiculo']){
    case '3':
        $col=54;
        $fila=$fila+5;
        break;
    case '4':
        $col=72;
        $fila=$fila+5;
        break;
    case '5':
        $col=88;
        $fila=$fila+5;
        break;
    case '6':
        $col=123;
        $fila=$fila+5;
        break;
    case '7':
        $col=180;
        $fila=$fila+5;
        break;
    case '8':
        $col=76;
        $fila=$fila+9;
        break;
    case '9':
        $col=106;
        $fila=$fila+9;
        break;
}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
$fila=208;
$pdf->SetXY(53,$fila);
$pdf->Cell(105,3,$rowveh['nombre_aseg'],1,3,'L');
$fila=$fila+5;
imprecuadro(36,$fila,$rowveh['numero_poliza'],$pdf);
if($rowveh['intervencion_aut']=='1'){$col=175;}
else{$col=193;}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
$finipol_veh=substr($finipol_veh,0,2).substr($finipol_veh,3,2).substr($finipol_veh,6,4);
$ffinpol_veh=substr($ffinpol_veh,0,2).substr($ffinpol_veh,3,2).substr($ffinpol_veh,6,4);
$fila=$fila+4;
imprecuadro(36,$fila,$finipol_veh,$pdf);
imprecuadro(79,$fila,$ffinpol_veh,$pdf);
if($rowveh['cobro_excedente']=='1'){$col=175;}
else{$col=193;}
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');

//Datos del propietario del vehiculo
$fila=$fila+8;
$pdf->SetXY(19,$fila);
$pdf->Cell(85,3,$rowveh['pape_prop'],1,3,'L');
$pdf->SetXY(114,$fila);
$pdf->Cell(85,3,$rowveh['sape_prop'],1,3,'L');
$fila=$fila+6;
$pdf->SetXY(19,$fila);
$pdf->Cell(85,3,$rowveh['pnom_prop'],1,3,'L');
$pdf->SetXY(114,$fila);
$pdf->Cell(85,3,$rowveh['snom_prop'],1,3,'L');
switch($rowveh['tipo_ident_prop']){
    case 'CC':
        $col=50;
        break;
    case 'CE':
        $col=55;
        break;
    case 'PA':
        $col=59;
        break;
    case 'NI':
        $col=63;
        break;
    case 'TI':
        $col=67;
        break;
    case 'RC':
        $col=71;
        break;    
}
$fila=$fila+7;
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
imprecuadro(127,$fila,$rowveh['numero_ident_prop'],$pdf);
$fila=$fila+4;
imprecuadro(49,$fila,$rowveh['direccion_prop'],$pdf);
$consdep="SELECT codigo_mun,nombre_mun,municipio.codigo_dep,departameto.nombre_dep
FROM municipio
INNER JOIN departameto on departameto.codigo_dep=municipio.codigo_dep
WHERE codigo_mun='$rowveh[municipio_prop]'";
$consdep=mysqli_query($conexion,$consdep);
$rowdep=mysqli_fetch_array($consdep);
//$mun=substr($rowdep['codigo_mun'],strlen($rowdep['depa_mun']),3);
$mun=$rowdep['codigo_mun'];
$fila=$fila+5;
imprecuadro(45,$fila,$rowdep['nombre_dep'],$pdf);
imprecuadro(127,$fila,$rowdep['codigo_dep'],$pdf);
imprecuadro(153,$fila,$rowveh['telefono_prop'],$pdf);
$fila=$fila+4;
imprecuadro(45,$fila,$rowdep['nombre_mun'],$pdf);
imprecuadro(127,$fila,$mun,$pdf);

//---------Segunda pagina
$pdf->AddPage();
$pdf->Image('imagenes/FURIPSPAG2.jpg',15,10,185,250);

//Datos del conductor
$fila=33;
$pdf->SetXY(20,$fila);
$pdf->Cell(80,3,$rowveh['pape_cond'],1,3,'L');
$pdf->SetXY(115,$fila);
$pdf->Cell(80,3,$rowveh['sape_cond'],1,3,'L');
$fila=$fila+7;
$pdf->SetXY(20,$fila);
$pdf->Cell(80,3,$rowveh['pnom_cond'],1,3,'L');
$pdf->SetXY(115,$fila);
$pdf->Cell(80,3,$rowveh['snom_cond'],1,3,'L');
switch($rowveh['tipo_ident_cond']){
    case 'CC':
        $col=49;
        break;
    case 'CE':
        $col=54;
        break;
    case 'PA':
        $col=59;
        break;
    case 'TI':
        $col=63;
        break;
    case 'RC':
        $col=67;
        break;
    case 'AS':
        $col=71;
        break;    
}
$fila=$fila+6;
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
imprecuadro(127,$fila,$rowveh['numero_ident_cond'],$pdf);
$fila=$fila+5;
imprecuadro(49,$fila,$rowveh['direccion_cond'],$pdf);

$consdep="SELECT codigo_mun,nombre_mun,municipio.codigo_dep,departameto.nombre_dep
FROM municipio
INNER JOIN departameto on departameto.codigo_dep=municipio.codigo_dep
WHERE codigo_mun='$rowveh[municipio_cond]'";
$consdep=mysqli_query($conexion,$consdep);
$rowdep=mysqli_fetch_array($consdep);
//$mun=substr($rowdep[codi_mun],strlen($rowdep[depa_mun]),3);
$mun=$rowdep['codigo_mun'];
$fila=$fila+5;
imprecuadro(45,$fila,$rowdep['nombre_dep'],$pdf);
imprecuadro(127,$fila,$rowdep['codigo_dep'],$pdf);
imprecuadro(153,$fila,$rowveh['telefono_cond'],$pdf);
$fila=$fila+4;
imprecuadro(45,$fila,$rowdep['nombre_mun'],$pdf);
imprecuadro(153,$fila,$mun,$pdf);

//Datos de la remision
$consrem="SELECT vw_furips_remision.cod_tipo_referemcia,vw_furips_remision.fecha_remi,vw_furips_remision.hora_salida,vw_furips_remision.nombre_ent_remite,vw_furips_remision.profesional_remite,vw_furips_remision.cargo_remite,vw_furips_remision.fecha_ingre_remi,vw_furips_remision.nombre_prof,vw_furips_remision.cargo_usu
FROM vw_furips_remision
WHERE vw_furips_remision.id_reclamacion='$_POST[id_reclamacion]'";
//echo $consrem;
$consrem=mysqli_query($conexion,$consrem);
if(mysqli_num_rows($consrem)<>0){
    $rowrem=mysqli_fetch_array($consrem);
    $fech_rem='';
    $fing_rem='';
    if($rowrem['fecha_remi']<>'0000-00-00' and $rowrem['fecha_remi']<>''){$fech_rem=cambiafechadmy($rowrem['fecha_remi']);}
    if($rowrem['fecha_ingre_remi']<>'0000-00-00' and $rowrem['fecha_ingre_remi']<>''){$fing_rem=cambiafechadmy($rowrem['fecha_ingre_remi']);}
    $fila=$fila+9;
    $fech_rem=substr($fech_rem,0,2).substr($fech_rem,3,2).substr($fech_rem,6,4);
    imprecuadro(45,$fila,$fech_rem,$pdf);
    $fila=$fila+5;
    imprecuadro(45,$fila,$rowrem['nombre_ent_remite'],$pdf);
    $fila=$fila+4;
    imprecuadro(45,$fila,$rowrem['profesional_remite'],$pdf);
    imprecuadro(140,$fila,$rowrem['cargo_remite'],$pdf);
    $fila=$fila+5;
    /*imprecuadro(45,$fila,substr($rowemp[dire_emp],0,51),$pdf);
    $fila=$fila+4;
    imprecuadro(45,$fila,"NARIÑO",$pdf);
    imprecuadro(127,$fila,"52",$pdf);
    imprecuadro(152,$fila,$rowemp[tele_emp],$pdf);
    $fila=$fila+5;
    imprecuadro(45,$fila,"PASTO",$pdf);
    imprecuadro(127,$fila,"001",$pdf);*/
    //imprecuadro(45,$fila,substr($rowemp[dire_emp],0,51),$pdf);
    $fila=$fila+4;
    imprecuadro(45,$fila,"NARIÑO",$pdf);
    imprecuadro(127,$fila,"52",$pdf);
    //imprecuadro(152,$fila,$rowemp[tele_emp],$pdf);
    $fila=$fila+5;
    imprecuadro(45,$fila,"PASTO",$pdf);
    imprecuadro(127,$fila,"001",$pdf);
    $fila=$fila+4;
    $fing_rem=substr($fing_rem,0,2).substr($fing_rem,3,2).substr($fing_rem,6,4);
    imprecuadro(45,$fila,$fing_rem,$pdf);
    $fila=$fila+5;
    imprecuadro(45,$fila,$rowemp['nombre_ent'],$pdf);
    $fila=$fila+5;
    imprecuadro(45,$fila,$rowrem['nombre_prof'],$pdf);
    imprecuadro(140,$fila,$rowrem['cargo_usu'],$pdf);
    $fila=$fila+4;
    imprecuadro(45,$fila,$rowemp['direccion_ent'],$pdf);
    $fila=$fila+5;
    imprecuadro(45,$fila,'NARIÑO',$pdf);
    imprecuadro(127,$fila,'52',$pdf);
    //imprecuadro(153,$fila,$rowemp[telrec_rem],$pdf);
    $fila=$fila+4;
    imprecuadro(45,$fila,'PASTO',$pdf);
    imprecuadro(153,$fila,'52001',$pdf);
}

$fila=119;

//Datos de la atencion
$consate="SELECT vw_furips_atencion.fecha_ingreso,vw_furips_atencion.fecha_egreso,vw_furips_atencion.codigo_cie_princ_ingr,vw_furips_atencion.codigo_cie_rel1_ingr,vw_furips_atencion.codigo_cie_rel2_ingr,vw_furips_atencion.codigo_cie_princ_egre,vw_furips_atencion.codigo_cie_rel1_egre,vw_furips_atencion.codigo_cie_rel2_egre,vw_furips_atencion.pnom_prof,vw_furips_atencion.snom_prof,vw_furips_atencion.pape_prof,vw_furips_atencion.sape_prof,vw_furips_atencion.numero_iden_prof,vw_furips_atencion.tipo_iden_prof,vw_furips_atencion.registro_usu
FROM vw_furips_atencion
WHERE vw_furips_atencion.id_reclamacion='$_POST[id_reclamacion]'";
//echo $consate;
$consate=mysqli_query($conexion,$consate);
$rowate=mysqli_fetch_array($consate);
$fila=$fila+5;
//imprecuadro(183,$fila,$rowate['foli_ate'],$pdf);
$fila=$fila+9;
$fila=172;
$fecing_ate=cambiafechadmy($rowate['fecha_ingreso']);
$horing_ate=substr($rowate['fecha_ingreso'],11,5);
$fecing_ate=substr($fecing_ate,0,2).substr($fecing_ate,3,2).substr($fecing_ate,6,4);
$fecsal_ate=cambiafechadmy($rowate['fecha_egreso']);
$fecsal_ate=substr($fecsal_ate,0,2).substr($fecsal_ate,3,2).substr($fecsal_ate,6,4);
$horsa_ate=substr($rowate['fecha_egreso'],11,5);
imprecuadro(35,$fila,$fecing_ate,$pdf);
imprecuadro(84,$fila,$horing_ate,$pdf);
imprecuadro(131,$fila,$fecsal_ate,$pdf);
imprecuadro(179,$fila,$horsa_ate,$pdf);
$fila=$fila+4;
imprecuadro(54,$fila,$rowate['codigo_cie_princ_ingr'],$pdf);
imprecuadro(153,$fila,$rowate['codigo_cie_princ_egre'],$pdf);
$fila=$fila+5;
imprecuadro(54,$fila,$rowate['codigo_cie_rel1_ingr'],$pdf);
imprecuadro(153,$fila,$rowate['codigo_cie_rel1_egre'],$pdf);
$fila=$fila+4;
imprecuadro(54,$fila,$rowate['codigo_cie_rel2_ingr'],$pdf);
imprecuadro(153,$fila,$rowate['codigo_cie_rel2_egre'],$pdf);
$fila=$fila+9;
$pdf->SetXY(19,$fila);
$pdf->Cell(80,3,$rowate['pape_prof'],1,3,'L');
$pdf->SetXY(114,$fila);
$pdf->Cell(80,3,$rowate['sape_prof'],1,3,'L');
$fila=$fila+6;
$pdf->SetXY(19,$fila);
$pdf->Cell(80,3,$rowate['pnom_prof'],1,3,'L');
$pdf->SetXY(114,$fila);
$pdf->Cell(80,3,$rowate['snom_prof'],1,3,'L');
switch($rowate['tipo_iden_prof']){
    case 'CC':
        $col=49;
        break;
    case 'CE':
        $col=54;
        break;
    case 'PA':
        $col=59;
        break;
}
$fila=$fila+7;
$pdf->SetXY($col,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
imprecuadro(127,$fila,$rowate['numero_iden_prof'],$pdf);
$fila=$fila+5;
imprecuadro(127,$fila,$rowate['registro_usu'],$pdf);
$fila=$fila+16;

//Datos del amparo que reclama
$consamp="SELECT furips_amparo.id_amparo,furips_amparo.id_reclamacion,furips_amparo.total_facturado,furips_amparo.total_reclamo,furips_amparo.total_transporte,furips_amparo.total_reclamo_trans,furips_amparo.total_folios
FROM furips_amparo WHERE furips_amparo.id_reclamacion='$_POST[id_reclamacion]'";
//echo $consamp;
$consamp=mysqli_query($conexion,$consamp);
$rowamp=mysqli_fetch_array($consamp);
$pdf->SetXY(92,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
$pdf->SetXY(110,$fila);
$pdf->Cell(25,3,$rowamp['total_facturado'],0,3,'R');
$pdf->SetXY(140,$fila);
$pdf->Cell(25,3,$rowamp['total_reclamo'],0,3,'R');
$fila=$fila+3;
$pdf->SetXY(92,$fila);
$pdf->Cell(3,3,"X",0,3,'C');
$pdf->SetXY(110,$fila);
$pdf->Cell(25,3,$rowamp['total_transporte'],0,3,'R');
$pdf->SetXY(140,$fila);
$pdf->Cell(25,3,$rowamp['total_reclamo_trans'],0,3,'R');
$fila=$fila+21;
$pdf->SetXY(20,$fila);
$pdf->Cell(60,3,$rowemp['nombreenc_ent'],0,3,'L');

$pdf->Output();
?>
