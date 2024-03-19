<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$conhis="SELECT vw_atencion.id_persona,vw_consulta.fecha_aten,vw_consulta.motivo_con,vw_consulta.enfermedad_con,vw_consulta.revisionsist_con,vw_consulta.subjetivo_con,vw_consulta.objetivo_con,vw_consulta.nombre_prof
FROM vw_consulta
INNER JOIN vw_atencion ON vw_atencion.id_aten=vw_consulta.id_aten
WHERE vw_atencion.id_persona='$_SESSION[id_persona]' ORDER BY vw_consulta.fecha_aten DESC";
$result=mysqli_query($conexion,$conhis);
?>
<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablaanam">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Fecha</td>
				<td>Motivo</td>		
				<td>Enfermedad</td>
				<td>Revisión</td>
				<td>Subjetivo</td>
				<td>Objetivo</td>
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
					<td><?php echo $row[6];?></td>
					<td><?php echo $row[7];?></td>					
				</tr>
				<?php
			}
			?>
		</tbody>		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaanam').DataTable();
	} );
</script>