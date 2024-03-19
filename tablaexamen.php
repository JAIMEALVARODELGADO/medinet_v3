<?php
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_mef, descripcion_mef, estado_mef FROM mae_examenfisico";
//echo $sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablaexamen">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Id</td>
				<td>Descripción</td>
				<td>Activo</td>
				<td>Detalles</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
		</thead>

		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				if($row[2]=='A')
					{$chequeado='checked';}
				else
					{$chequeado='';}
				?>
				<tr>
					<td><?php echo $row[0];?></td>
					<td><?php echo $row[1];?></td>					
					<td><input type="checkbox" <?php echo $chequeado;?> onclick="cambiarestado('<?php echo $row[0]?>')"></td>

					<td style="text-align: center;">
						<span class="btn btn-success btn.sm" title="Editar Detalles" onclick="examen_detalle('<?php echo $row[0]?>')">
							<i class="fas fa-briefcase"></i>
						</span>
					</td>

					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar El Registro" onclick="agregaFrmActualizar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-danger btn.sm" title="Borrar el Registro" onclick="eliminar('<?php echo $row[0]?>','<?php echo $row[1]?>')">
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
		$('#tablaconvenio').DataTable();
	} );
</script>