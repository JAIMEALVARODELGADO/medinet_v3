<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$sql="SELECT id_factura, SUBSTR(fecha_fac,1,10), numero_iden_per, nombre_pac, numero_conv, nombre_eps,valorneto_fac FROM vw_factura WHERE esta_fac='A' ORDER BY fecha_fac DESC LIMIT 100";
//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablafactura">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Detalle</td>
				<td>Fecha</td>
				<td>Identificacion</td>
				<td>Paciente</td>
				<td>EPS</td>
				<td>Convenio</td>
				<td>Valor Neto</td>
				<td>Editar</td>
				<td>Anular</td>
				<td>Cerrar</td>
			</tr>
		</thead>
		
		<tbody style="background-color: white">
			<?php
			while($row=mysqli_fetch_row($result)){
				?>
				<tr>
					<td style="text-align: center;">
						<span class="btn btn-success btn.sm" title="Editar detalles de la factura" onclick="editaritem('<?php echo $row[0]?>')">
							<i class="fas fa-list-alt"></i>
						</span>
					</td>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td><?php echo $row[5];?></td>
					<td><?php echo $row[4];?></td>
					<td align="right"><?php echo number_format($row[6],2,'.',',');?></td>
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar la Factura" onclick="FrmEditar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-danger btn.sm" title="Anular la factura" onclick="anular('<?php echo $row[0]?>','<?php echo $row[3]?>')">
							<i class="fas fa-minus-square"></i>
						</span>
					</td>
					<td style="text-align: center;">
						<span class="btn btn-success btn.sm" title="Cerrar la factura" onclick="cerrar('<?php echo $row[0]?>','<?php echo $row[3]?>')">
							<i class="fas fa-unlock"></i></span>
						</span>
					</td>
				<?php
			}
			?>
		</tbody>
		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tablafactura').DataTable();
	} );
</script>