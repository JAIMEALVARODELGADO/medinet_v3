<?php
session_start();
//Aqui evito la utilizacion de cache con fines de refrescar tablas
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$sql="SELECT id_persona,tipo_ident_per,numero_ident,nombre_per,direccion_per,telefono_per,nombre_mun
	FROM vw_furips_persona WHERE ".$_SESSION['gcondicionfurips']." ORDER BY numero_ident";
//echo "<br>".$sql;
$result=mysqli_query($conexion,$sql);
?>
<div>
	<table class="table table-hover table-sm table-bordered font13" id="tablafurips_persona">
		<thead style="background-color: #2574a9;color: white; font-weight: bold;">
			<tr>				
				<td>Tp. Ident.</td>
				<td>Identifición</td>
				<td>Nombre</td>
				<td>Dirección</td>
				<td>Teléfono</td>
				<td>Municipio</td>
				<td>Editar</td>				
			</tr>
		</thead>
		
		<tbody style="background-color: white">
			<?php
			if($_SESSION['gcondicionfurips']!=''){
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
							<span class="btn btn-warning btn.sm" data-toggle="modal" data-target="#Editar" title="Editar El Registro" onclick="editar('<?php echo $row[0]?>')">
							<span class="far fa-edit"></span>
						</span>
						</td>						
					</tr>
					<?php
				}
			}
			?>
		</tbody>
		
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tablafurips_persona').DataTable();
	} );
</script>