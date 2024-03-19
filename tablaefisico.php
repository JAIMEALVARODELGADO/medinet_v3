<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$conhis="SELECT vw_consulta_efisico.id_persona,DATE(vw_consulta_efisico.fecha_aten),vw_consulta_efisico.descripcion_exaf,vw_consulta_efisico.valor_exaf,vw_consulta_efisico.hallazgo_exaf,vw_consulta_efisico.nombre_prof
FROM vw_consulta_efisico
WHERE id_persona='$_SESSION[id_persona]' ORDER BY fecha_aten DESC";
//echo $conhis;
$result=mysqli_query($conexion,$conhis);
?>
<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablaef">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Fecha</td>				
				<td>Descripción</td>
				<td>Estado</td>
				<td>Hallazgo</td>
				<td>Profesional</td>				
			</tr>
		</thead>		

		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				?>
				<tr>					
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td><?php echo $row[4];?></td>
					<td><?php echo $row[5];?></td>
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