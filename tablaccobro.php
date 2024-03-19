<?php
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_ccobro, numero_ccob, fecha_ccob,nombre_eps, SUBSTR(concepto_ccob,1,40), estado_ccob FROM vw_cuentacobro";
//echo $sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablaccobro">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Facturas</td>
				<td>Número</td>
				<td>Fecha</td>
				<td>EPS</td>
				<td>Concepto</td>
				<td>Editar</td>
				<td>Cerrar</td>
				<td>Imprimir</td>
				<td>Rips</td>
			</tr>
		</thead>
		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				?>
				<tr>
					<td style="text-align: center;">
						<?php
						if($row[5]=='A'){
							?>
							<span class="btn btn-success btn.sm" title="Relacionar Facturas" onclick="relacionar('<?php echo $row[0]?>')">
								<i class="fas fa-list-alt"></i>
							</span>
							<?php
						}
						else{
							?>
							<span class="btn btn-secondary btn.sm" title="Relacionar Facturas">
								<i class="fas fa-list-alt"></i>
							</span>
							<?php	
						}
						?>
						
					</td>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td><?php echo $row[4];?>...</td>
					<td style="text-align: center;">
						<?php
						if($row[5]=='A'){
							?>
							<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar El Registro" onclick="agregaFrmActualizar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
							</span>
							<?php
						}
						else{
							?>
							<span class="btn btn-secondary btn.sm" title="Editar El Registro">
							<span class="far fa-edit"></span>
							</span>
							<?php	
						}
						?>

						
					</td>
					<td style="text-align: center;">
						<?php
						if($row[5]=='A'){
							?>
							<span class="btn btn-success btn.sm" title="Cerrar la cuenta" onclick="cerrar('<?php echo $row[0]?>','<?php echo $row[1]?>')">
							<i class="fas fa-unlock"></i></span>
							</span>
							<?php
						}
						else{
							?>
							<span class="btn btn-secondary btn.sm" title="Cerrar la cuenta">
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
					<td style="text-align: center;">
						<?php
						if($row[5]=='C'){
							?>
							<span class="btn btn-success btn.sm" title="Rips" onclick="rips('<?php echo $row[0]?>','<?php echo $row[1]?>')">
							<i class="fas fa-file-alt"></i>
							</span>
							<?php
						}
						else{
							?>
							<span class="btn btn-secondary btn.sm" title="Rips">
							<i class="fas fa-file-alt"></i>
							</span>
							<?php	
						}
						?>
						
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
		$('#tablaccobro').DataTable();
	} );
</script>