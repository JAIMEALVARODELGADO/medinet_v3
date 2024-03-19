<?php
session_start();

//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_resp, nombre_responsable,CONCAT(codigo_conglo,' ',descripcion_conglo) AS concepto_glosa,descripcion_cdet, fechacont_resp,observacion_resp,valoracepta_resp,estado_resp,IF(estado_resp='A','Activo','Anulado') AS estado FROM vw_glosa_respuesta WHERE id_glosa='$_SESSION[gid_glosa]'";
//echo $sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tabla">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Respondiente</td>
				<td>Concepto</td>
				<td>Detalle de Factura</td>
				<td>Fecha</td>				
				<td>Observación</td>
				<td>Valor Aceptado</td>
				<td>Estado</td>
				<td>Editar</td>
				<td>Anular</td>
			</tr>
		</thead>

		<tbody style="background-color: white">
			<?php
			$total=0;
			while($row=mysqli_fetch_row($result)){
				?>
				<tr>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td><?php echo $row[4];?></td>
					<td><?php echo $row[5];?></td>
					<td align="right"><?php echo number_format($row[6],2,'.',',');?></td>
					<td><?php echo $row[8];?></td>
					<td style="text-align: center;">						
						<?php						
						if($row[7]=='A'){
							$total=$total+$row[6];
							?>
								<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar El Registro" onclick="Actualizar('<?php echo $row[0]?>')">
									<span class="far fa-edit"></span>
								</span>
							<?php
						}
						else{
							?>
								<span class="btn btn-secondary btn.sm" title="Registro Anulado">
									<span class="far fa-edit"></span>
								</span>
							<?php
						}
						?>						
					</td>

					<td style="text-align: center;">
						<?php
						if($row[7]=='A'){
							?>
								<span class="btn btn-danger btn.sm" title="Anular el Registro" onclick="anular('<?php echo $row[0]?>','<?php echo $row[5]?>')">
									<span class="fas fa-minus-square"></span>
								</span>
							<?php
						}
						else{
							?>
								<span class="btn btn-secondary btn.sm" title="Registro Anulado">
									<span class="fas fa-minus-square"></span>
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
		<tfoot>
			<tr>
				<td align="right" colspan="5"><b>Total</b></td>
				<td align="right"><b><?php echo number_format($total,2,'.',',');?></b></td>
			</tr>
			<?php
			if($total>$_SESSION['gvalor_glo']){
				?>
				<tr>
					<td align="center" colspan="9">
						<div class="alert alert-danger" role="alert">
		  					<i class="fas fa-file-invoice-dollar"></i>  Atención!!! 
		  					Los valores aceptados superan el valor glosado
						</div>
					</td>
				</tr>
				<?php
				
			}
			?>
		</tfoot>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tabla').DataTable();
	} );
</script>