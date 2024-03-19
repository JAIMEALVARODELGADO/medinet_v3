<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT vw_furips_reclamacion.id_reclamacion,vw_furips_reclamacion.numero_fac,vw_furips_reclamacion.numero_iden_per,vw_furips_reclamacion.nombre_pac,vw_furips_reclamacion.fecha_even,if(vw_furips_reclamacion.estado_recla='A','Abierta','Cerrada') AS estado,vw_furips_reclamacion.estado_recla
	FROM vw_furips_reclamacion WHERE ".$_SESSION['gcondicionfurips']." ORDER BY id_reclamacion";
//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql);	

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
			if($_SESSION['gcondicionfurips']!=''){
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
			}
			?>
		</tbody>
		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tablafurips').DataTable();
	} );
</script>