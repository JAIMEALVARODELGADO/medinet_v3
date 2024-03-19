<?php
session_start();
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$sql="SELECT id_ripsap,numero_fac,fechaproc_rap,numeroauto_rap,codigoproc_rap,ambito_rap,finalidad_rap,personal_rap,dxprincipal_rap,dxrelac_rap,complica_rap,valor_rap FROM vw_ripsap WHERE id_ccobro='$_SESSION[gid_ccobro]' ORDER BY numero_fac";
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
				<td>Cód. Proced</td>
				<td>Ambito</td>
				<td>Finalidad</td>				
				<td>Dx Principal</td>
				<td>Dx Rel</td>
				<td>Complicación</td>				
				<td>Valor</td>				
				<td>Editar</td>
				<td>Eliminar</td>
				
			</tr>
		</thead>
		
		<tbody style="background-color: white">
			<?php
			$factura=0;
			$totalproc=0;			
			$totalprocfac=0;			
			while($row=mysqli_fetch_array($result)){
				if($factura==0){$factura=$row['numero_fac'];}
				?>
				<tr>
					<?php
						if($factura==$row['numero_fac']){
							$totalprocfac+=$row['valor_rap'];
						}
						else{
							?>
							<tr>
								<td align="right" colspan="9">Total Factura <?php echo $factura;?></td>
								<td align="right"><b><?php echo number_format($totalprocfac,2,'.',',');?></b></td>
							</tr>
							<?php
							$totalprocfac=$row['valor_rap'];
							$factura=$row['numero_fac'];
						}

					?>
					<td><?php echo $row['numero_fac'];?></td>
					<td><?php echo $row['fechaproc_rap'];?></td>
					<td><?php echo $row['numeroauto_rap'];?></td>
					<td><?php echo $row['codigoproc_rap'];?></td>
					<td><?php echo $row['ambito_rap'];?></td>
					<td><?php echo $row['finalidad_rap'];?></td>					
					<td><?php echo $row['dxprincipal_rap'];?></td>
					<td><?php echo $row['dxrelac_rap'];?></td>
					<td><?php echo $row['complica_rap'];?></td>					
					<td align="right"><?php echo number_format($row['valor_rap'],2,'.',',');?></td>					
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
				$totalproc+=$row['valor_rap'];
			}
			?>
			<tr>
				<td align="right" colspan="9">Total Factura <?php echo $factura;?></td>
				<td align="right"><b><?php echo number_format($totalprocfac,2,'.',',');?></b></td>
			</tr>
			<tr>
				<td align="right" colspan="9">Totales</td>
				<td align="right"><b><?php echo number_format($totalproc,2,'.',',');?></b></td>
			</tr>
		</tbody>
		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		//$('#tablaripsap').DataTable();
	} );
</script>