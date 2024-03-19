<?php
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_agh,nombre_prof,profesion_usu,fecha_agh,nombre_operador,fechagen_agh FROM vw_horarios WHERE estado_agh='PE'";
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablahorario">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Profesional</td>
				<td>Profesion</td>
				<td>Fecha</td>
				<td>Operador</td>
				<td>Fecha Generación</td>
				<td></td>
				<td>Editar</td>
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
					<td><?php echo $row[3];?></td>
					<td><?php echo $row[4];?></td>
					<td><?php echo $row[5];?></td>
					<td></td>
					<td style="text-align: center;">
						<span class="btn btn-secondary btn.sm" data-toggle="modal" title="Editar El Registro" onclick="#">
							<span class="far fa-edit"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-danger btn.sm" title="Borrar el Registro" onclick="eliminarDatos('<?php echo $row[0]?>','<?php echo $row[3]?>','<?php echo $row[1]?>')">
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
		$('#tablahorario').DataTable();
	} );
</script>