<?php
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_abono,nombre_eps,numero_fac,valorneto_fac,fecha_abono,documento_abono,valor_abono,dias_mora_abono,observacion_abono,nombre_operador
FROM vw_glosa_abono WHERE estado_abono='A'";
//echo $sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font11" id="tablaabono">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>				
				<td>Eps</td>
				<td>Factura</td>				
				<td>Valor Factura</td>
				<td>Fecha Abono</td>
				<td>Documento</td>
				<td>Valor Abono</td>				
				<td>Días Mora</td>
				<td>Observación</td>
				<td>Responsable</td>
				<td>Editar</td>				
				<td>Cerrar</td>
				<td>Eliminar</td>
			</tr>
		</thead>

		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				?>
				<tr>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td align="right"><?php echo number_format($row[3],2,'.',',');?></td>
					<td><?php echo $row[4];?></td>
					<td><?php echo $row[5];?></td>
					<td align="right"><?php echo number_format($row[6],2,'.',',');?></td>
					<td align="right"><?php echo number_format($row[7],0,'.',',');?></td>
					<td><?php echo $row[8];?></td>
					<td><?php echo $row[9];?></td>
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar El Registro" onclick="Actualizar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>					
					<td style="text-align: center;">
						<span class="btn btn-success btn.sm" title="Cerrar el Abono" onclick="cerrar('<?php echo $row[0]?>','<?php echo $row[2]?>')">
							<i class="fas fa-unlock"></i></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-danger btn.sm" title="Borrar el Registro" onclick="eliminar('<?php echo $row[0]?>','<?php echo $row[2]?>')">
							<span class="fas fa-trash"></span>
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
		$('#tablaabono').DataTable();
	} );
</script>