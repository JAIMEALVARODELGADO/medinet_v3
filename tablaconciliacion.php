<?php
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_conciliacion,nombre_eps,numero_fac,fecha_conciliacion,fecha_firma_concil,valorneto_fac,valor_conciliar,valor_entidad,valor_eps,saldo_concil,observacion_concil,nombre_operador,id_factura
FROM vw_glosa_conciliacion WHERE estado_concil='A'";
//echo $sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font11" id="tablaconciliacion">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>				
				<td>Eps</td>
				<td>Factura</td>
				<td>Fecha Conciliación</td>
				<td>Fecha Firma</td>
				<td>Valor Factura</td>
				<td>Valor a Conciliar</td>
				<td>Valor a Favor Ent</td>
				<td>Valor a Favor EPS</td>
				<td>Saldo</td>
				<td>Observación</td>
				<td>Responsable</td>
				<td>Editar</td>				
				<td>Cerrar</td>
				<!--<td>Abonos</td>-->
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
					<td align="right"><?php echo number_format($row[5],2,'.',',');?></td>
					<td align="right"><?php echo number_format($row[6],2,'.',',');?></td>
					<td align="right"><?php echo number_format($row[7],2,'.',',');?></td>
					<td align="right"><?php echo number_format($row[8],2,'.',',');?></td>
					<td align="right"><?php echo number_format($row[9],2,'.',',');?></td>
					<td><?php echo $row[10];?></td>
					<td><?php echo $row[11];?></td>					
					<td style="text-align: center;">
						<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#modalEditar" title="Editar El Registro" onclick="Actualizar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
					</td>					
					<td style="text-align: center;">
						<span class="btn btn-success btn.sm" title="Cerrar la Conciliación" onclick="cerrar('<?php echo $row[0]?>','<?php echo $row[2]?>')">
							<i class="fas fa-unlock"></i></span>
						</span>
					</td>
					<!--<td style="text-align: center;">
						<span class="btn btn-info btn.sm" data-toggle="modal" data-target="#modal_abonos" title="Lista de Abonos" onclick="actualizar_fac('<?php echo $row[12]?>')">
							<i class="fas fa-file-alt"></i>
						</span>
					</td>-->
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
		$('#tablaconciliacion').DataTable();
	} );
</script>