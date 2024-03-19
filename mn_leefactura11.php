<?php
//session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

//require_once "clases/conexion.php";
/*$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT vw_furips_reclamacion.id_reclamacion,vw_furips_reclamacion.numero_fac,vw_furips_reclamacion.numero_iden_per,vw_furips_reclamacion.nombre_pac,vw_furips_reclamacion.fecha_even,if(vw_furips_reclamacion.estado_recla='A','Abierta','Cerrada') AS estado,vw_furips_reclamacion.estado_recla
	FROM vw_furips_reclamacion WHERE ".$_SESSION['gcondicionfurips']." ORDER BY id_reclamacion";
//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql);*/	

//echo "<br>".$_POST['file'];
echo "<br>".$_POST['archivo'];

echo "<br><b>Nombre : </b>".$_FILES['archivo']['name'];

if($_FILES['archivo']['error']>0){
  echo "error: ".$_FILES['archivo']['error']."<br>";
}
else{
  echo "<br><b>Nombre : </b>".$_FILES['archivo']['name'];
  echo "<br><b>Tipo : </b>".$_FILES['archivo']['type'];
  echo "<br><b>Tamano : </b>".$_FILES['archivo']['size'];
  echo "<br><b>Error :</b>".$_FILES['archivo']['error'];
  //move_uploaded_file($_FILES['archivo']['tmp_name'],'archivostmp/'.$_FILES['archivo']['name']);
  move_uploaded_file($_FILES['archivo']['tmp_name'],'archivostmp/'.$_FILES['archivo']['name']);  
  $nombre_arc="archivostmp/".$_FILES['archivo']['name'];
}



?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablafurips">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>				
				<td>Factura</td>
				<td>Identifición</td>
				<td>Nombre</td>
				<td>Fecha Evento</td>
				<td>Estado</td>
				<td>Editar</td>
				<td>Cerrar</td>
				<td>Imprimir</td>
			</tr>
		</thead>
		
		<tbody style="background-color: white">
			<?php
			/*if($_SESSION['gcondicionfurips']!=''){
				while($row=mysqli_fetch_row($result)){
					?>
					<tr>					
						<td><?php echo $row[1];?></td>
						<td><?php echo $row[2];?></td>
						<td><?php echo $row[3];?></td>
						<td><?php echo $row[4];?></td>
						<td><?php echo $row[5];?></td>
						<td style="text-align: center;">
							<?php
								if($row[6]=='A'){
									?>
										<span class="btn btn-warning btn.sm" data-toggle="modal" title="Editar formulario FURIPS" onclick="editar('<?php echo $row[0]?>')">
											<span class="far fa-edit"></span>
										</span>
									<?php
								}
								else{
									?>
										<span class="btn btn-secondary btn.sm" data-toggle="modal" title="FURIPS Cerrado para editar">
											<span class="far fa-edit"></span>
										</span>
									<?php
								}
							?>						
						</td>					
						<td style="text-align: center;">
							<?php
								if($row[6]=='A'){
									?>
										<span class="btn btn-success btn.sm" title="Cerrar el FURIPS" onclick="cerrar('<?php echo $row[0]?>','<?php echo $row[3]?>')">
											<i class="fas fa-unlock"></i></span>
										</span>
									<?php
								}
								else{
									?>
										<span class="btn btn-secondary btn.sm" title="FURIPS Cerrado">
											<i class="fas fa-unlock"></i></span>
										</span>
									<?php
								}
							?>
						</td>
						<td style="text-align: center;">
							<span class="btn btn-success btn.sm" title="Imprimir" onclick="imprimir('<?php echo $row[0]?>')">
								<i class="fas fa-print"></i></span>
							</span>
						</td>
					</tr>
					<?php
				}
			}*/
			?>
		</tbody>
		
	</table>
</div>

<!--<script type="text/javascript">
	$(document).ready(function() {
		$('#tablafurips').DataTable();
	} );
</script>-->







/****************************************************************************************
<?php
session_register('Gidusuactbd'); 
//echo $Gidusuactbd; 
?>
<!-- Programa que actualiza la base de datos de la fiduciaria-->
<html>
<head>
<meta charset="utf-8">
<?
//Aqui cargo las funciones de validaci�n de fechas
include("funciones.php");
?>
<title>Actualiza BD REGION 3</title>

<!-- THE WAIT SCREEEN!!! -->
<div ID="waitDiv" style="position:absolute;left:250;top:150;visibility:hidden">
<center>
<table border=0 cellpadding=0 cellspacing=0 width="250"><tr><td bgcolor="#000000">
<table cellpadding=2 cellspacing=1 border=0 width="100%"><tr><td bgcolor="#48409A">
<center><font color="#F9E78C" face="Verdana, Arial, Helvetica, sans-serif" size="3"><b>Actualizando Información REGION 3...</b></font><br> <img src="imagenes/await.gif" border="0" width="200" height="20"><br>
<font size="2" color="#F9E78C" face="Verdana, Arial, Helvetica, sans-serif">Espere por favor...</font></center>
</td>
</tr>
</table>
</td></tr>
</table>
</center>
</div>

<script>
<!--
    var DHTML = (document.getElementById || document.all || document.layers);
    function ap_getObj(name) {
      if (document.getElementById) {
        return document.getElementById(name).style;
      } else if (document.all) {
        return document.all[name].style;
      } else if (document.layers) {
        return document.layers[name];
      }
    }
    function ap_showWaitMessage(div,flag)  {
      if (!DHTML)
        return;
      var x = ap_getObj(div);
      x.visibility = (flag) ? 'visible':'hidden'
      if(! document.getElementById)
        if(document.layers)
          x.left=280/2;
//      return true;
    }
    ap_showWaitMessage('waitDiv', 1);

  //-->
</SCRIPT>
<!-- END -->

</head>
<body bgcolor="#E6E8FA">
<?

//Conexion con la base
//mysql_connect("localhost","root","");
mysql_connect("192.168.4.111","root","7336200");//Servidor ip publica
//selecci�n de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud");
//mysql_select_db("proinsalud_1");


function subedatos($nombre_arc)
{
  //echo "<br>archivo:... ".$nombre_arc."<br>";
  //Aqui borro el contenido de la tabla wcosta
  $regerror=0;
  mysql_query("TRUNCATE TABLE usuarios_reg3");  
  if (isset($nombre_arc)){
    $fp = fopen ( $nombre_arc , "r" );
    $reg=0;
    while (( $data = fgetcsv ( $fp , 1000 , ";" )) !== FALSE ) { // Mientras hay l�neas que leer...
      $i = 0;      
      foreach($data as $row) {
        $campo[$i]=$row;
        $i++ ;
        //echo "<br>".$i;
        //echo " ".$campo[$i];
      }
      $tipo_doc_usu='';      
      if(strpos($campo[6],'Ciudadan')<>0){
        $tipo_doc_usu='CC';
      }
      if(strpos($campo[6],'Extranjer')<>0){
        $tipo_doc_usu='CE';
      }
      switch ($campo[6]){
        case 'CÃ©dula de CiudadanÃ­a';
          $tipo_doc_usu='CC';
          break;
        case 'Certificado de Nacido Vivo':
          $tipo_doc_usu='NV';
          break;
        case 'CÃ©dula de ExtranjerÃ­a':
          $tipo_doc_usu='CE';
          break;
        case 'Registro Civil':
          $tipo_doc_usu='RC';
          break;
        case 'Tarjeta de Identidad':
          $tipo_doc_usu='TI';
          break;
      }
      $nombre=$campo[2];
      if(!empty($campo[3])){$nombre=$nombre.' '.$campo[3];}
      $nombre=$nombre.' '.$campo[4];
      if(!empty($campo[5])){$nombre=$nombre.' '.$campo[5];}        
      $sql_="INSERT INTO usuarios_reg3(tipo_doc_usu,numero_doc_usu,nombre_usu,departam_usu,municip_usu,tipo_usu,estado_usu) VALUES ('$tipo_doc_usu','$campo[7]','$nombre','$campo[26]','$campo[24]','$campo[14]','$campo[22]')";
      //echo $sql_;
      //mysql_query("INSERT INTO wcosta VALUES ('$campo[0]','$campo[1]','$campo[2]','$campo[3]','$campo[4]','$campo[5]','$campo[6]','$campo[7]','$campo[8]','$campo[9]','$campo[10]','$campo[11]','$campo[12]','$campo[13]','$campo[14]') ");
      //echo "<br><br>".$sql_;
      mysql_query($sql_);      
      if(mysql_affected_rows()<>1){
        $regerror++;
        //echo "<br>".$regerror;
      }
      $reg++;      
    }
    fclose ( $fp );
    echo "<br>Se procesaron: $reg Registros";
  }
  else{
    echo "Directorio no valido";
  }  
  echo "<br>Registros con errores (Tipo y Número de Identificación duplicados): ".$regerror;
  return($reg);
}

set_time_limit(0);
$hoy=date("Y").'-'.date("m").'-'.date("d");

///*************************
if($_FILES[archivo][error]>0){
  echo "error: ".$_FILES[archivo][error]."<br>";
}
else{
  echo "<br><b>Nombre : </b>".$_FILES['archivo']['name'];
  echo "<br><b>Tipo : </b>".$_FILES['archivo']['type'];
  echo "<br><b>Tamano : </b>".$_FILES['archivo']['size'];
  echo "<br><b>Error :</b>".$_FILES['archivo']['error'];
  //move_uploaded_file($_FILES['archivo']['tmp_name'],'archivostmp/'.$_FILES['archivo']['name']);
  move_uploaded_file($_FILES['archivo']['tmp_name'],'archivostmp/'.$_FILES['archivo']['name']);  
  $nombre_arc="archivostmp/".$_FILES['archivo']['name'];
}
///*************************


//$nombre_arc=$HTTP_POST_FILES['archivo']['name'];
//$nombre_arc="archivostmp/".$nombre_arc;
//$nombre_arc="archivostmp/BDFIDUPREVISORA.csv";

/*if (is_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'])) { 
  copy($HTTP_POST_FILES['archivo']['tmp_name'], 'archivostmp/'.$HTTP_POST_FILES['archivo']['name']); 
  $subio = true; 
} */
//if($subio) { 
  echo "<br>El archivo subio con exito"; 
  $nregcar=subedatos($nombre_arc);
  if($nregcar<>0){
    //activar($activado,$nuevo,$nuevocontrato,$actualizamun);
    //suspender($fechacot,$fechaben,$novedad,$suspendido,$encontrado,$bensuspend);
	  //unlink($nombre_arc);
  }
//} 
/*else{ 
  echo "<br>El archivo no cumple con las reglas establecidas"; 
} */



//mysql_close();

?>
</table>

<!-- SCRIPT DE ESPERA -->
<script language="javascript" type="text/javascript">
<!--
ap_showWaitMessage('waitDiv', 0);
//-->
</SCRIPT>

</body>
</html>
****************************/