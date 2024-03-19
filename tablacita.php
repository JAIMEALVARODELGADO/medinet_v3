<?php
session_start();
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$sql="SELECT id_agc,fecha_agh,nombre_profesional,numero_iden_per,nombre_persona,nombre_eps,estado_agc,id_agh FROM vw_citas WHERE ".$_SESSION['gcondicion'];

//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql);
?>

<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablahorario2">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>
				<td>Identificacion</td>
				<td>Nombre</td>
				<td>EPS</td>
				<td>Profesion</td>
				<td>Fecha</td>
				<td>Sel</td>
			</tr>
		</thead>
		
		<tbody style="background-color: white">
			<?php
			if(mysqli_num_rows($result)<>0){
				while($row=mysqli_fetch_row($result)){
					?>
					<tr>
						<td><?php echo $row[3];?></td>
						<td><?php echo $row[4];?></td>
						<td><?php echo $row[5];?></td>
						<td><?php echo $row[2];?></td>
						<td><?php echo $row[1];?></td>
						<td align="center"><input type="radio" id="elegir" name="elegir" onclick="seleccionar('<?php echo $row[0]?>','<?php echo $row[7]?>')"></td>
					</tr>
					<?php
				}
			}
			?>
		</tbody>
		
	</table>
</div>
