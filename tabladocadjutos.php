<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$conhis="SELECT vw_consulta_adjuntos.id_persona,DATE(vw_consulta_adjuntos.fecha_aten),vw_consulta_adjuntos.descripcion_adj,vw_consulta_adjuntos.nombre_prof,vw_consulta_adjuntos.archivo_adj
FROM vw_consulta_adjuntos
WHERE id_persona='$_SESSION[id_persona]' ORDER BY fecha_aten DESC";
echo $conhis;
$result=mysqli_query($conexion,$conhis);
?>
<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablaef">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Fecha</td>
				<td>Descripción</td>
				<td>Profesional</td>
				<td>Visualizar</td>
			</tr>
		</thead>		

		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				$archivo="adjuntos/".$row[4];
				?>
				<tr>					
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td>
					<a href="<?php echo $archivo;?>" target="new">
							<span class="btn btn-primary btn.sm" data-toggle="modal" title="Visualizar el archivo">
							<i class="fas fa-search"></i>
							</span>
						</a>
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
		$('#tablaef').DataTable();
	} );
</script>