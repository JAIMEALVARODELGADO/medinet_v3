<?php
session_start();

//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_cdet, descripcion_cdet, tipo_cdet, codigo_cdet, valor_cdet, estado_cdet FROM convenio_detalle WHERE id_convenio='$_SESSION[gid_convenio]'";
//echo $sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablaact_convenio">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Descripción</td>
				<td>Reportar en</td>
				<td>Código a Reportar</td>
				<td>Valor</td>
				<td>Activo</td>				
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
		</thead>

		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				if($row[5]=='A')
					{$chequeado='checked';}
				else
					{$chequeado='';}
				?>
				<tr>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td align="right"><?php echo number_format($row[4],2,'.',',');?></td>
					<td><input type="checkbox" <?php echo $chequeado;?> onclick="cambiarestado('<?php echo $row[0]?>')"></td>

					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar El Registro" onclick="Actualizar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-secondary btn.sm" title="Borrar el Registro">
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
		$('#tablaact_convenio').DataTable();
	} );
</script>