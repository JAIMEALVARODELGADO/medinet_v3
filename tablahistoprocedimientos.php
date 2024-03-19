<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$conhis="SELECT vw_procedimiento.id_procedimiento,vw_procedimiento.fecha_aten,vw_procedimiento.descripcion_cups,vw_procedimiento.descrip_dxpr,vw_procedimiento.observacion_proc,vw_procedimiento.nombre_profe
	FROM vw_procedimiento
	INNER JOIN vw_atencion ON vw_atencion.id_aten=vw_procedimiento.id_aten
	WHERE vw_procedimiento.id_persona='$_SESSION[id_persona]' ORDER BY fecha_aten DESC";
//echo $conhis;
$result=mysqli_query($conexion,$conhis);
?>
<div>
	<table class="table table-hover table-sm table-bordered font13" id="tabladx">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Fecha</td>
				<td>Procedimiento</td>
				<td>Dx Principal</td>
				<td>Observación</td>
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
		$('#tabladx').DataTable();
	} );
</script>