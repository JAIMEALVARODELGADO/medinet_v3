<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_factura, numero_fac, SUBSTR(fecha_fac,1,10), numero_iden_per, nombre_pac,valorneto_fac FROM vw_factura WHERE esta_fac='C' AND id_eps='$_SESSION[gid_eps]' AND ISNULL(id_ccobro)";
//echo $sql;
$result=mysqli_query($conexion,$sql);
//echo $_SESSION['gid_ccobro'];
$id_ccobro=$_SESSION['gid_ccobro'];
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablafacsinrel">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Número</td>
				<td>Fecha</td>
				<td>Identificación</td>
				<td>Nombre</td>
				<td>Valor</td>				
				<td>Seleccionar</td>
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
					<td style="text-align: center;">
						<span class="btn btn-success btn.sm" title="Adicionar a la cuenta de cobro" onclick="seleccionar('<?php echo $row[0]?>','<?php echo $row[1]?>','<?php echo $id_ccobro;?>')">
							<i class="fas fa-angle-double-right"></i>
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
		$('#tablafacsinrel').DataTable();
	} );
</script>