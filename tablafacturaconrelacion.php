<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$sql="SELECT SUM(valorneto_fac) FROM vw_factura WHERE id_ccobro='$_SESSION[gid_ccobro]'";
//echo $sql;
$result=mysqli_query($conexion,$sql);
$row=mysqli_fetch_row($result);
$valor_ccobro=$row[0];

$sql="SELECT id_factura, numero_fac, SUBSTR(fecha_fac,1,10), numero_iden_per, nombre_pac,valorneto_fac FROM vw_factura WHERE id_ccobro='$_SESSION[gid_ccobro]'";
//echo $sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablafacconrel">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Quitar</td>
				<td>Número</td>
				<td>Fecha</td>
				<td>Identificación</td>
				<td>Nombre</td>
				<td>Valor</td>				
			</tr>
		</thead>
		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				?>
				<tr>
					<td style="text-align: center;">
						<span class="btn btn-success btn.sm" title="Quitar de esta lista" onclick="quitar('<?php echo $row[0]?>','<?php echo $row[1]?>')">
							<i class="fas fa-angle-double-left"></i>
						</span>						
					</td>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td><?php echo $row[4];?></td>
					<td align="right"><?php echo number_format($row[5],2,'.',',');?></td>					
				</tr>
				<?php
			}			
			?>
			<tr>
				<td colspan="5" align="right">Total Cuenta de Cobro</td>
				<td align="right"><b><?php echo number_format($valor_ccobro,2,'.',',');?></b></td>				
			</tr>
		</tbody>
		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tablafacconrel').DataTable();
	} );
</script>