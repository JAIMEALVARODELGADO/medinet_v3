<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_glosa,fecharecep_glo,nombre_eps,numero_fac,valor_glo,valor_fav_eps,nombre_responsable,motivo_glo,fecha_envio_glo,guia_glo FROM vw_glosa WHERE ".$_SESSION['gcondicion']." ORDER BY fecharecep_glo";
//echo $sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablaglosa">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Fecha Rec</td>
				<td>Eps</td>
				<td>Factura</td>
				<td>Valor Glosa</td>
				<td>Valor Aceptado</td>
				<td>Responsable Respuesta</td>
				<td>Motivo de la Glosa</td>
				<td>Fecha de Envío</td>
				<td>Guia</td>
				<td>Imprimir</td>				
			</tr>
		</thead>

		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				/*if($row[5]=='A')
					{$chequeado='checked';}
				else
					{$chequeado='';}*/
				?>
				<tr>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td align="right"><?php echo number_format($row[4],2,'.',',');?></td>
					<td align="right"><?php echo number_format($row[5],2,'.',',');?></td>
					<td><?php echo $row[6];?></td>
					<td><?php echo $row[7];?></td>
					<td><?php echo $row[8];?></td>
					<td><?php echo $row[9];?></td>
					<td style="text-align: center;">
						<span class="btn btn-success btn.sm" title="Imprimir" onclick="imprimir('<?php echo $row[0]?>')">
							<i class="fas fa-print"></i></span>
						</span>
					</td>
				</tr>
				<?php
			}
			?>			
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaglosa').DataTable();
	} );
</script>