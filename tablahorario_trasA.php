<?php
session_start();
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$sql="SELECT id_agh,nombre_prof,profesion_usu,fecha_agh,estado_agh FROM vw_horarios WHERE ".$_SESSION['gcondicionA'];
//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablahorariotrasA">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Profesional</td>
				<td>Profesion</td>
				<td>Fecha</td>
				<td>Estado</td>
				<td>Trasladar</td>
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
					<td style="text-align: center;">
						<span class="btn btn-success btn.sm" title="Trasladar" onclick="validar('<?php echo $row[0]?>','<?php echo $row[3]?>')"><i class="fas fa-arrow-circle-right"></i>
						</span>
					</td>					
				<?php
			}
			?>
		</tbody>
		
	</table>
</div>
