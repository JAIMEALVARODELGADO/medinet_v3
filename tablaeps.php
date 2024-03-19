<?php
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_eps,codigo_eps,nit_eps,nombre_eps,direccion_eps,telefono_eps,contacto_eps FROM eps";
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablaeps">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Código</td>
				<td>Nit</td>
				<td>Nombre</td>
				<td>Dirección</td>
				<td>Teléfono</td>
				<td>Contacto</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
		</thead>

		<!--<tfoot style="background-color: #E5E6E8;color: white; font-weight: bold;">
			<tr>
				<td>Código</td>
				<td>Nit</td>
				<td>Nombre</td>
				<td>Dirección</td>
				<td>Teléfono</td>
				<td>Contacto</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
		</tfoot>-->

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
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar El Registro" onclick="agregaFrmActualizar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-danger btn.sm" title="Borrar el Registro" onclick="eliminarDatos('<?php echo $row[0]?>','<?php echo $row[3]?>')">
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
		$('#tablaeps').DataTable();
	} );
</script>