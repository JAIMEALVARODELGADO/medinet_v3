<?php
session_start();
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$sql="SELECT id_ripsac, numero_fac, fechacon_rac, numeroauto_rac, codigocon_rac, finalidad_rac, causaexte_rac, dxprincipal_rac, dxrel1_rac, dxrel2_rac, dxrel3_rac, tipodxprin_rac,valorcon_rac,valorcmode_rac FROM vw_ripsac WHERE id_ccobro='$_SESSION[gid_ccobro]' ORDER BY numero_fac";
//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablaripsac">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Factura</td>				
				<td>Fecha</td>
				<td>Autorización</td>
				<td>Cód. Consulta</td>
				<td>Finalidad</td>
				<td>Causa Ext.</td>
				<td>Dx Principal</td>
				<td>Dx Rel1</td>
				<td>Dx Rel2</td>
				<td>Dx Rel3</td>
				<td>Tipo Dx Pr</td>
				<td>Valor</td>
				<td>Cuota Mod</td>
				<td>Editar</td>
				<td>Eliminar</td>
				
			</tr>
		</thead>
		
		<tbody style="background-color: white">
			<?php
			$factura=0;
			$totalcon=0;
			$totalmod=0;
			$totalconfac=0;
			$totalmodfac=0;
			while($row=mysqli_fetch_row($result)){
				if($factura==0){$factura=$row[1];}
				?>
				<tr>
					<?php
						if($factura==$row[1]){
							$totalconfac+=$row[12];
							$totalmodfac+=$row[13];
						}
						else{
							?>
							<tr>
								<td align="right" colspan="11">Total Factura <?php echo $factura;?></td>
								<td align="right"><b><?php echo number_format($totalconfac,2,'.',',');?></b></td>
								<td align="right"><b><?php echo number_format($totalmodfac,2,'.',',');?></b></td>
							</tr>
							<?php
							$totalconfac=$row[12];
							$totalmodfac=$row[13];
							$factura=$row[1];
						}

					?>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td><?php echo $row[4];?></td>
					<td><?php echo $row[5];?></td>
					<td><?php echo $row[6];?></td>
					<td><?php echo $row[7];?></td>
					<td><?php echo $row[8];?></td>
					<td><?php echo $row[9];?></td>
					<td><?php echo $row[10];?></td>
					<td><?php echo $row[11];?></td>
					<td align="right"><?php echo number_format($row[12],2,'.',',');?></td>
					<td align="right"><?php echo number_format($row[13],2,'.',',');?></td>
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar el Registro" onclick="FrmEditar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-danger btn.sm" title="Eliminar el Registro" onclick="eliminar('<?php echo $row[0]?>')">
							<i class="fas fa-trash"></i>
						</span>
					</td>
				</tr>
				<?php
				$totalcon+=$row[12];
				$totalmod+=$row[13];
			}
			?>
			<tr>
				<td align="right" colspan="11">Total Factura <?php echo $factura;?></td>
				<td align="right"><b><?php echo number_format($totalconfac,2,'.',',');?></b></td>
				<td align="right"><b><?php echo number_format($totalmodfac,2,'.',',');?></b></td>
			</tr>
			<tr>
				<td align="right" colspan="11">Totales</td>
				<td align="right"><b><?php echo number_format($totalcon,2,'.',',');?></b></td>
				<td align="right"><b><?php echo number_format($totalmod,2,'.',',');?></b></td>
			</tr>
		</tbody>
		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		//$('#tablaripsac').DataTable();
	} );
</script>