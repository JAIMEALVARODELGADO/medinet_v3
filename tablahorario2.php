<?php
session_start();
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$sql="SELECT id_agh,nombre_prof,profesion_usu,fecha_agh,estado_agh FROM vw_horarios WHERE ".$_SESSION['gcondicion'];
//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablahorario2">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Profesional</td>
				<td>Profesion</td>
				<td>Fecha</td>
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
					<td align="center"><input type="radio" id="elegir" name="elegir" onclick="seleccionar('<?php echo $row[0]?>')"></td>
				</tr>
				<?php
			}
			?>
		</tbody>
		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		//$('#tablahorario2').DataTable();
	} );
</script>