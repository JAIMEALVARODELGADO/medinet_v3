<?php
session_start();
require_once "clases/conexion.php";
require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();

$concta="SELECT id_eps,nombre_eps,numero_ccob,codigo_eps,fecha_ccob FROM vw_cuentacobro WHERE id_ccobro='$_SESSION[gid_ccobro]'";
//echo $concta;
$concta=mysqli_query($conexion,$concta);
$rowcta=mysqli_fetch_row($concta);
$id_eps=$rowcta[0];
$nombre_eps=$rowcta[1];
$numero_ccob=$rowcta[2];
$codigo_eps=$rowcta[3];
$fecha_ccob=$rowcta[4];


$condicion="id_ccobro='$_SESSION[gid_ccobro]' AND esta_fac='C'";
$consultaent="SELECT codigopres_ent,nombre_ent,SUBSTR(tipoiden_ent,1,2) AS tipoiden_ent,numeroiden_ent FROM entidad";
//echo "<br>".$consultaent;
$consultaent=mysqli_query($conexion,$consultaent);
$rowent=mysqli_fetch_row($consultaent);
$codigopres_ent=$rowent[0];
$nombre_ent=$rowent[1];
$tipoiden_ent=$rowent[2];
$numeroiden_ent=$rowent[3];

$archivous='';
$archivoaf='';
$archivoac='';
$archivoap='';
$regaf=0;
$regus=0;
$regac=0;
$regap=0;

//Aqui genero AF
$consulta="SELECT numero_fac,SUBSTR(fecha_fac,1,10) AS fecha_fac,fechaini_fac,fechafin_fac,valortot_fac,copago_fac,descuento_fac,valorneto_fac,numero_conv
FROM vw_factura
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysqli_query($conexion,$consulta);
if(mysqli_num_rows($consulta)<>0){
    $regaf=mysqli_num_rows($consulta);
    $shtml="";
    while($row=mysqli_fetch_array($consulta)){
        $shtml=$shtml.$codigopres_ent.",";
        $shtml=$shtml.$nombre_ent.",";
        $shtml=$shtml.$tipoiden_ent.",";
        $shtml=$shtml.$numeroiden_ent.",";
        $shtml=$shtml.$row['numero_fac'].",";
        $shtml=$shtml.cambiafechadmy($row['fecha_fac']).",";
        $shtml=$shtml.cambiafechadmy($row['fechaini_fac']).",";
        $shtml=$shtml.cambiafechadmy($row['fechafin_fac']).",";
        $shtml=$shtml.$codigo_eps.",";
        $shtml=$shtml.$nombre_eps.",";
        $shtml=$shtml.$row['numero_conv'].",";
        $shtml=$shtml.",";
        $shtml=$shtml.",";
        $shtml=$shtml.$row['copago_fac'].",";        
        $shtml=$shtml."0,";
        $shtml=$shtml.$row['descuento_fac'].",";
        $shtml=$shtml.$row['valorneto_fac']."\r\n";        
    }
}
$archivoaf='AF'.$numero_ccob;
$scarpeta=""; //carpeta donde guardar el archivo. 
//debe tener permisos 775 por lo menos 
$sfile="planos/AF".$numero_ccob.".csv"; //ruta del archivo a generar 
$fp=fopen($sfile,"w"); 
fwrite($fp,$shtml); 
fclose($fp);
?>
<div class="row">
	<label class="col-sm-3 col-form-label">
	<a href="<?php echo $sfile;?>" type="button" class="btn btn-primary"><?php echo $archivoaf;?> <i class="fas fa-angle-double-down"></i></a>	
	</label>
</div>

<?php
//Aqui genero US
$consulta="SELECT tipoiden,numero_iden_per,pape_per,sape_per,pnom_per,snom_per,edad,sexo,codigo_mun,zona,tipousuario
FROM vw_usuarios_factura_rips
WHERE $condicion GROUP BY id_persona";
//echo "<br>".$consulta;
$consulta=mysqli_query($conexion,$consulta);
if(mysqli_num_rows($consulta)<>0){
    $regus=mysqli_num_rows($consulta);
    $shtml="";
    while($row=$consulta->fetch_array()){      
      $shtml=$shtml.TRIM(str_replace("\r","",$row['tipoiden'])).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$row['numero_iden_per'])).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$codigo_eps)).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$row['tipousuario'])).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$row['pape_per'])).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$row['sape_per'])).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$row['pnom_per'])).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$row['snom_per'])).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$row['edad'])).",";
      $shtml=$shtml.TRIM(str_replace("\r","",'1')).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$row['sexo'])).",";
      $dep=SUBSTR($row['codigo_mun'],0,2);
      $mun=SUBSTR($row['codigo_mun'],2,3);
      $shtml=$shtml.TRIM(str_replace("\r","",$dep)).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$mun)).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$row['zona']))."\r\n";
    }
}
$archivous='US'.$numero_ccob;
$scarpeta=""; //carpeta donde guardar el archivo. 
//debe tener permisos 775 por lo menos 
$sfile="planos/US".$numero_ccob.".csv"; //ruta del archivo a generar 
$fp=fopen($sfile,"w"); 
fwrite($fp,$shtml); 
fclose($fp);

?>
<div class="row">
	<label class="col-sm-3 col-form-label">
	<a href="<?php echo $sfile;?>" type="button" class="btn btn-primary"><?php echo $archivous;?> <i class="fas fa-angle-double-down"></i></a>	
	</label>
</div>

<?php
//Aqui genero AC
$consulta="SELECT id_ripsac, numero_fac,tipoiden,numero_iden_per, fechacon_rac, numeroauto_rac, codigocon_rac, finalidad_rac, causaexte_rac, dxprincipal_rac, dxrel1_rac, dxrel2_rac, dxrel3_rac, tipodxprin_rac,valorcon_rac,valorcmode_rac FROM vw_ripsac WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysqli_query($conexion,$consulta);
if(mysqli_num_rows($consulta)<>0){
    $regac=mysqli_num_rows($consulta);
    $shtml="";
    while($row=mysqli_fetch_array($consulta)){
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['numero_fac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$codigopres_ent)).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['tipoiden'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['numero_iden_per'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['fechacon_rac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['numeroauto_rac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['codigocon_rac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['finalidad_rac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['causaexte_rac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['dxprincipal_rac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['dxrel1_rac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['dxrel2_rac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['dxrel3_rac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['tipodxprin_rac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['valorcon_rac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['valorcmode_rac'])).",";
      $valorneto=$row['valorcon_rac']-$row['valorcmode_rac'];
      $shtml=$shtml.TRIM(str_replace("\r", "",$valorneto))."\r\n";
    }
    $archivoac='AC'.$numero_ccob;
    $scarpeta=""; //carpeta donde guardar el archivo. 
    //debe tener permisos 775 por lo menos 
    $sfile="planos/AC".$numero_ccob.".csv"; //ruta del archivo a generar 
    $fp=fopen($sfile,"w");
    fwrite($fp,$shtml); 
    fclose($fp);
}


?>
<div class="row">
	<label class="col-sm-3 col-form-label">
	<a href="<?php echo $sfile;?>" type="button" class="btn btn-primary"><?php echo $archivoac;?> <i class="fas fa-angle-double-down"></i></a>	
	</label>
</div>

<?php

//Aqui genero AP
$consulta="SELECT id_ripsap, numero_fac,tipoiden,numero_iden_per, fechaproc_rap, numeroauto_rap, codigoproc_rap, ambito_rap,finalidad_rap, personal_rap, dxprincipal_rap, dxrelac_rap, complica_rap, formareali_rap, valor_rap FROM vw_ripsap WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysqli_query($conexion,$consulta);
if(mysqli_num_rows($consulta)<>0){
    $regap=mysqli_num_rows($consulta);
    $shtml="";
    while($row=mysqli_fetch_array($consulta)){
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['numero_fac'])).",";
      $shtml=$shtml.TRIM(str_replace("\r","",$codigopres_ent)).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['tipoiden'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['numero_iden_per'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['fechaproc_rap'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['numeroauto_rap'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['codigoproc_rap'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['ambito_rap'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['finalidad_rap'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['personal_rap'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['dxprincipal_rap'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['dxrelac_rap'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['complica_rap'])).",";
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['formareali_rap'])).",";      
      $shtml=$shtml.TRIM(str_replace("\r", "",$row['valor_rap']))."\r\n";
      //$valorneto=$row['valorcon_rac']-$row['valorcmode_rac'];
      //$shtml=$shtml.TRIM(str_replace("\r", "",$valorneto))."\r\n";
    }
    $archivoap='AP'.$numero_ccob;
    $scarpeta=""; //carpeta donde guardar el archivo. 
    //debe tener permisos 775 por lo menos 
    $sfile="planos/AP".$numero_ccob.".csv"; //ruta del archivo a generar 
    $fp=fopen($sfile,"w");
    fwrite($fp,$shtml); 
    fclose($fp);
}


?>
<div class="row">
  <label class="col-sm-3 col-form-label">
  <a href="<?php echo $sfile;?>" type="button" class="btn btn-primary"><?php echo $archivoap;?> <i class="fas fa-angle-double-down"></i></a>  
  </label>
</div>




<?php
//Aqui genero CT
$shtml="";
if(!empty($archivous)){
  $shtml=$shtml.$codigopres_ent.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivous.",";
  $shtml=$shtml.$regus."\r\n";
}
if(!empty($archivoaf)){
  $shtml=$shtml.$codigopres_ent.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivoaf.",";
  $shtml=$shtml.$regaf."\r\n";
}
if(!empty($archivoac)){
  $shtml=$shtml.$codigopres_ent.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivoac.",";
  $shtml=$shtml.$regac."\r\n";
}
if(!empty($archivoap)){
  $shtml=$shtml.$codigopres_ent.",";
  $hoy=hoy();
  $shtml=$shtml.$hoy.",";
  $shtml=$shtml.$archivoap.",";
  $shtml=$shtml.$regap."\r\n";
}
$archivoct='CT'.$numero_ccob;
$scarpeta=""; //carpeta donde guardar el archivo. 
//debe tener permisos 775 por lo menos 
$sfile="planos/CT".$numero_ccob.".csv"; //ruta del archivo a generar 
$fp=fopen($sfile,"w"); 
fwrite($fp,$shtml); 
fclose($fp);

?>
<div class="row">
	<label class="col-sm-3 col-form-label">
	<a href="<?php echo $sfile;?>" type="button" class="btn btn-primary"><?php echo $archivoct;?> <i class="fas fa-angle-double-down"></i></a>	
	</label>
</div>

