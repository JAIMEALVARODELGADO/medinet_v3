<?php
session_start();
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_aten, fecha_aten, numero_iden_per, nombre,codigo_cups,descripcion_cups, nombre_eps, nombre_profesional, id_persona,id_con,tipoaten FROM vw_atencion_fac WHERE facturado<>'S' AND ".$_SESSION['gcondicion']." ORDER BY fecha_aten DESC LIMIT 100";
//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablaconsultas">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Fecha</td>
				<td>Identificacion</td>
				<td>Paciente</td>
				<td>Cód CUPS</td>
				<td>Descripción</td>
				<td>Eps</td>
				<td>Profesional</td>
				<td>Sel</td>
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
					<?php
					//echo $row[10];
						if($row[10]=='C'){
							?>
								<td align="center"><input type="checkbox" id="id_con[]" name="id_con[]" value="<?php echo $row[9];?>" onclick="seleccionar('<?php echo $row[0]?>','<?php echo $row[3]?>','<?php echo $row[8]?>')"></td>
							<?php
						}
						else{
							?>
								<td align="center"><input type="checkbox" id="id_procedimiento[]" name="id_procedimiento[]" value="<?php echo $row[9];?>" onclick="seleccionar('<?php echo $row[0]?>','<?php echo $row[3]?>','<?php echo $row[8]?>')"></td>
							<?php
						}
					?>
					
				</tr>
				<?php
			}
			?>
		</tbody>
		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		//$('#tablaconsultas').DataTable();
	} );
</script>